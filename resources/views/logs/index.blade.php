<div class="panel panel-inverse panel-hover-icon">
  <div class="panel-heading">
    <div class="panel-heading-btn">
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" onclick="reload_data()"><i class="fa fa-redo"></i></a>
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
    </div>
    <h4 class="panel-title">{{ $title }}</h4>
  </div>
  <div class="panel-toolbar bg-black-transparent-1 m-b-20">
    <div class="row text-center">
      <div class="col-md-6">
        <div class="float-md-left">
          @ability('root','bersihkan-log')
            <button class="btn btn-warning" onclick="clear_data('{{ $uri }}')"><i class="fas fa-history"></i> Hapus Log Lama</button>
          @endability
          @ability('root','lihat-log')
            <button class="btn btn-success btn_action" hidden onclick="view_data('{{ $uri }}')"><i class="fas fa-tasks"></i> Lihat</button>
          @endability
          @ability('root','hapus-log')
            <button class="btn btn-danger btn_action" hidden onclick="delete_data('{{ $uri }}')"><i class="fas fa-trash-alt"></i> Hapus</button>
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
            <th>Nama Log</th>
            <th>Deskripsi</th>
            <th>Judul</th>
            <th>User</th>
            <th>Waktu Log</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="modal fade" id="modal_{{ $uri }}" tabindex="-1" role="dialog" aria-labelledby="modal_{{ $uri }}" aria-hidden="true"></div>
  </div>
</div>

<script type="text/javascript">
  App.setPageTitle('{{ Settings::get_settings('app_name') }} | {{ $title }}' );
  App.restartGlobalFunction();
  $.getScript('{{ asset('plugins/sweetalert2/dist/sweetalert2.all.min.js') }}'),
  $.when(
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
      fixedHeader: true,
      searchHighlight: true,
      processing: false,
      serverSide: true,
      ajax: {url:'{{ route("activitylog.list") }}'},
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
        { data: 'log_name'},
        { data: 'description'},
        { data: 'subject_type'},
        { data: 'causer_id'},
        { data: 'created_at'}
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

  function clear_data(val) {
    swal({
      title: 'Apakah anda yakin ?',
      text: "Data tidak dapat dikemabalikan setelah terhapus!",
      type: "info",
      showCancelButton: true,
      confirmButtonClass: "btn-warning",
      confirmButtonText: 'Clear Logs',
      closeOnConfirm: false,
    }).then((result) => {
      if (result.value) {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
          type:"GET",
          url:val + '/clean-logs',
          success: function(data) {
            swal.close();
            reload_data();
          },
          error: function(data) {
            swal('Error','Someting Wrong','error');
          }
        }).done(function(data){
          swal({type: 'success',title: 'Data dibersihkan',text:data,showConfirmButton: false,timer: 1500});
          $.gritter.add({title:"Log Clean!",text:data});
        })
      }
    })
  }
</script>
