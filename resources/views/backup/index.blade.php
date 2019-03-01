<div class="panel panel-inverse panel-hover-icon">
  <div class="panel-heading">
    <div class="panel-heading-btn">
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" onclick="reload_data()"><i class="fa fa-redo"></i></a>
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
    </div>
    <h4 class="panel-title">{{ $title }}</h4>
  </div>
  <div class="panel-toolbar bg-theme m-b-10" style="height: 55px">
    <div class="row text-center">
			<div class="col-md-6">
        <div class="float-md-left">
         @ability('root','backup-database')
            <button class="btn btn-primary m-b-5" onclick="backup_db('{{ $uri }}')"><i class="fas fa-arrow-alt-circle-down"></i> Backup</button>
          @endability
          @ability('root','restore-database')
            <button class="btn btn-success btn_action m-b-5" hidden onclick="restore_db('{{ $uri }}')"><i class="fas fa-level-up-alt"></i> Restore</button>
          @endability
          @ability('root','dowsnload-database')
            <button class="btn btn-info btn_action m-b-5" hidden onclick="download('{{ $uri }}')"><i class="fas fa-download"></i> Download</button>
          @endability
          @ability('root','hapus-backup')
            <button class="btn btn-danger btn_action m-b-5" hidden onclick="delete_data('{{ $uri }}')"><i class="fas fa-trash-alt"></i> Hapus</button>
          @endability
        </div>
      </div>
      <div class="col-md-6">
        <div class="float-md-right">
          <div class="input-group stylish-input-group">
            <input type="text" class="form-control" placeholder="Cari..." id="cari">
            <span class="input-group-addon bg-red text-white" id="clear_search">
              <span class="fas fa-times"></span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table width="100%" class="table table-bordered table-hover">
        <thead class="bg-grey-transparent-1">
          <tr>
            <th>Nama</th>
            <th>Ukuran</th>
            <th>Tipe</th>
            <th>Tgl. Backup</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
  App.setPageTitle('{{ Settings::get_settings('app_name') }} | {{ $title }}' );
  App.restartGlobalFunction();
  $.getScript('{{ asset('plugins/sweetalert2/dist/sweetalert2.all.min.js') }}'),
  $.when(
    $.getScript('{{ asset("plugins/sweetalert2/dist/sweetalert2.all.min.js") }}'),
    $.getScript('{{ asset("js/back-end/crud.js") }}'),
    $.Deferred(function( deferred ){
      $(deferred.resolve);
    })
  ).done(function() {
    $.fn.dataTable.ext.errMode = 'none';
    table = $(".table").length&&$(".table").DataTable({
      dom:"l<'float-md-right m-b-20'B>tip",
      buttons:[
        { extend: 'colvis', className: 'btn-grey' },
        { extend: 'excel', className: 'btn-success' },
        { extend: 'pdf', className: 'btn-danger' },
        { extend: 'print', className: 'btn-primary' },
      ],
      rowId: 'id',
      searchHighlight: true,
      processing: false,
      serverSide: true,
      ajax: {url:'{{ route("backup.list") }}'},
      deferRender: true,
      responsive:true,
      select: true,
      colReorder:!0,
      sorting: [[0,"asc"]],
      pagingType: "full_numbers",
      stateSave: true,
      language: {"zeroRecords": "Data {{ $title }} tidak ditemukan..."},
      lengthMenu: [[10, 20, 50, 100, 200, -1], [10, 20, 50, 100, 200, "Semua"]],
      columns: [
        { data: 'name'},
        { data: 'size'},
        { data: 'mime'},
        { data: 'last_modified'}
      ]
    });

    $('#cari').on( 'keyup', function () {
      table.search( this.value ).draw();
    });

    $("#clear_search").click(function(){
      table.search('').draw();
      $('#cari').val('');
    });

    $('.modal').draggable({
      handle: ".modal-header"
    });

    table.on("click","tr",function() {
      if ($(this).hasClass("selected")) {
        $(".btn_action").removeAttr("hidden");
      }
      else {
        $(".btn_action").attr("hidden","true");
      }
    });

    table.on("draw",function () {
      var body = $(table.table().body());
      body.unhighlight();
      body.highlight(table.search());
    });
  });
  function backup_db(val){
    swal({
      title: 'Backup Database',
      text: "Proses backup membutuhkan waktu lama, jangan mengalihkan halaman sebelum proses backup selesai",
      type: "info",
      showCancelButton: true,
      confirmButtonClass: "btn-primary",
      confirmButtonText: 'Backup',
    }).then((result) => {
      if (result.value) {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
          type:"GET",
          url:val+'/backup',
          success: function(data){
            swal.close();
            reload_data();
          },
          error: function(data){
            error = data.responseJSON.message;
            swal('Error',error,'error');
            console.log(data);
          }
        }).done(function(data){
          swal({type: 'success',title: 'Database dibackup',text:data,showConfirmButton: false,timer: 1500});
          $.gritter.add({title:"Database di backup!",text:"Anda membackup database."});
        })
      }
    })
  }

  function restore_db(val){
    var data = table.row(".selected").data();
    var name = data["name"];
    swal({
      title: 'Restore Database',
      text: "Proses restore membutuhkan waktu lama, jangan mengalihkan halaman sebelum proses restore selesai",
      type: "info",
      showCancelButton: true,
      confirmButtonClass: "btn-primary",
      confirmButtonText: 'Restore',
    }).then((result) => {
      if (result.value) {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
          type:"GET",
          url:val + '/restore/' + name,
          success: function(data){
            swal.close();
          },
          error: function(data){
            error = data.responseJSON.message;
            swal('Error',error,'error');
            console.log(data);
          }
        }).done(function(data){
          swal({type: 'success',title: 'Database direstore',text:data,showConfirmButton: false,timer: 1500});
          $.gritter.add({title:"Anda merestore database!",text:data});
        })
      }
    })
  }
</script>
