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
                  <th>Telp.</th>
                  <th width="1%">Jumlah Transaksi</th>
                  <th width="20%">Transaksi Terakhir</th>
                </tr>
            </thead>
        </table>
      </div>
      <div class="modal fade" id="modal_pelanggan" tabindex="-1" role="dialog" aria-labelledby="modal_pelanggan" aria-hidden="true"></div>
    </div>
</div>

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script>
  App.setPageTitle('{{ Settings::get_settings('app_name') }} | {{ $title }}' );
  App.restartGlobalFunction();
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
      searchHighlight: true,
      processing: false,
      serverSide: true,
      ajax: {url:'{{ route("pelanggan.list") }}'},
      deferRender: true,
      responsive:true,
      select: false,
      colReorder:!0,
      sorting: [[0,"asc"]],
      pagingType: "full_numbers",
      stateSave: true,
      language: {"zeroRecords": "Data {{ $title }} tidak ditemukan..."},
      lengthMenu: [[10, 20, 50, 100, 200, -1], [10, 20, 50, 100, 200, "Semua"]],
      columns: [
        { data: 'nama'},
        { data: 'tlp', sClass:'text-nowrap'},
        { data: 'trans', sClass:'text-nowrap text-center'},
        { data: 'last_trans', sClass:'text-nowrap text-center'}
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
</script>
<!-- ================== END PAGE LEVEL JS ================== -->
