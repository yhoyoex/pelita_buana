<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

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
          @ability('root','add-user')
            <a href="javascript:;" class="btn btn-primary m-b-5" onclick="add_data('{{ $uri }}')"><i class="fas fa-plus-circle"></i> Tambah {{ $title }}</a>
          @endability
          @ability('root','edit-user')
            <a href="javascript:;" class="btn btn-warning btn_action m-b-5" hidden onclick="edit_data('{{ $uri }}')"><i class="fas fa-pencil-alt"></i> Edit</a>
          @endability
          @ability('root','delete-user')
            <a href="javascript:;" class="btn btn-danger btn_action m-b-5" hidden onclick="delete_data('{{ $uri }}')"><i class="fas fa-trash-alt"></i> Hapus</a>
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
                  <th width="1%">Aktif</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>No. HP</th>
                  <th>Roles</th>
                  <th>Last Login</th>
                  <th>Last IP</th>
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
      ajax: {url:'{{ route("users.list") }}'},
      deferRender: true,
      responsive:true,
      select: true,
      colReorder:!0,
      sorting: [[1,"asc"]],
      pagingType: "full_numbers",
      stateSave: true,
      language: {"zeroRecords": "Data {{ $title }} tidak ditemukan..."},
      lengthMenu: [[10, 20, 50, 100, 200, -1], [10, 20, 50, 100, 200, "Semua"]],
      columns: [
        { data: 'active', sClass:'text-center' },
        { data: 'name' },
        { data: 'username' },
        { data: 'email' },
        { data: 'contact' },
        { data: 'roles' },
        { data: 'last_login_at' },
        { data: 'last_login_ip' }
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
