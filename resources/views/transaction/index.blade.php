<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('plugins/jquery-smart-wizard/src/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

<div class="panel panel-inverse panel-with-tabs panel-hover-icon">
	<div class="panel-heading p-0">
		<div class="panel-heading-btn m-r-10 m-t-10">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" onclick="reload_data()"><i class="fa fa-redo"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
		</div>
		<div class="tab-overflow">
			<ul class="nav nav-tabs nav-tabs-inverse" id="tabs">
				<li class="nav-item prev-button"><a href="javascript:;" data-click="prev-tab" class="nav-link text-success"><i class="fa fa-arrow-left"></i></a></li>
				<li class="nav-item"><a href="#nav-tab-1" data-toggle="tab" class="nav-link active">Daftar Transaksi</a></li>
				<li class="nav-item next-button"><a href="javascript:;" data-click="next-tab" class="nav-link text-success"><i class="fa fa-arrow-right"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade active show" id="nav-tab-1">
			<div class="panel-toolbar bg-black-transparent-1 m-b-20" style="margin: -15px -15px 20px -15px;">
				<div class="row text-center">
					<div class="col-md-6">
						<div class="float-md-left">
							@ability('root','buat-transaksi')
							<a href="javascript:;" id="btn_new" class="btn btn-primary m-b-5" onclick="new_data()"><i class="fas fa-plus-circle"></i> Buat Transaksi</a>
							@endability
							@ability('root','lihat-transaksi')
							<a href="javascript:;" id="btn_edit" class="btn btn-info btn_action m-b-5" hidden onclick="view_trans()"><i class="fas fa-tasks"></i> Detail Transaksi</a>
							@endability
              {{-- @ability('root','manual-transaksi')
              <a href="javascript:;" id="btn_edit" class="btn btn-indigo btn_action m-b-5" hidden onclick="generate_no_trans('{{ $uri }}')"><i class="fas fa-tasks"></i> Manual Transaksi</a>
              @endability --}}
              @ability('root','generate-notrans')
							<a href="javascript:;" id="btn_edit" class="btn btn-lime m-b-5" onclick="generate_no_trans('{{ $uri }}')"><i class="fas fa-magic"></i> Generate No. Trans</a>
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
			<div class="table-responsive">
				<table width="100%" class="table table-bordered">
					<thead class="bg-grey-transparent-1">
						<tr>
							<th width="1%">No. Trans</th>
							<th width="1%">No. Tiket</th>
              <th width="1%">Jenis</th>
              <th>Masuk</th>
							<th>Pelanggan</th>
							<th>Nopol</th>
							<th>Keluar</th>
							<th>Durasi</th>
							<th>Tarif (Rp.)</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_{{ $uri }}" tabindex="-1" role="dialog" aria-labelledby="modal_{{ $uri }}" aria-hidden="true"></div>
<script>
	App.setPageTitle('{{ Settings::get_settings('app_name') }} | {{ $title }}' );
	App.restartGlobalFunction();
  $.getScript('https://cdn.jsdelivr.net/npm/recta/dist/recta.js'),
  $.getScript('{{ asset('plugins/sweetalert2/dist/sweetalert2.all.min.js') }}'),
	$.when(
    $.getScript('{{ asset("js/back-end/crud.js") }}'),
		$.Deferred(function( deferred ){
			$(deferred.resolve);
		})
	).done(function() {
    $('#cari').val('');
		$.fn.dataTable.ext.errMode = 'none';
		table = $(".table").length&&$(".table").DataTable({
			rowCallback: function( row, data ) {
				if ( data.status == 0 ) {
					// $('td', row).addClass('bg-blue-transparent-1');
					$('td', row).css({'border-color': 'lightgrey'});
				} else if(data.status == 1) {
					$('td', row).addClass('bg-green-transparent-1');
					$('td', row).css({'border-color': 'lightgrey'});
				}
        else if(data.status == 2) {
					$('td', row).addClass('bg-red-transparent-1');
					$('td', row).css({'border-color': 'lightgrey'});
				}
			},
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
			ajax: {url:'{{ route("transaction.list") }}', },
			deferRender: true,
			responsive:!0,
			select: 'single',
			colReorder:!0,
			sorting: [[0,"desc"]],
			pagingType: "full_numbers",
			stateSave: true,
      stateSaveCallback: function(settings,data) {
        localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
      },
      stateLoadCallback: function(settings) {
        return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
      },
			language: {"zeroRecords": "Data {{ $title }} tidak ditemukan..."},
			lengthMenu: [[10, 20, 50, 100, 200, -1], [10, 20, 50, 100, 200, "Semua"]],
			columns: [
				{ data: 'no_trans', sClass:'text-nowrap'},
				{ data: 'no_tiket', sClass:'text-nowrap'},
				{ data: 'jenis', sClass:'text-nowrap'},
				{ data: 'tgl_masuk', sClass:'text-nowrap'},
				{ data: 'pelanggan.nama'},
				{ data: 'kendaraan.nopol'},
        { data: 'tgl_keluar', sClass:'text-nowrap'},
        { data: 'durasi', sClass:'text-nowrap'},
        { data: 'tarif', sClass:'text-nowrap text-right'},
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

	function new_data() {
		var id = 0;
		var element_trans = document.getElementById("#trans"+id);
		$.ajax({
			type:"GET",
			url: "{{ route('transaction.create') }}",
			success: function(res) {
				if (element_trans !== null) {
					$('#tabs .itab'+id+'').tab('show');
					return false;
				} else if (id === ''){
					return false;
				} else {
					$('#tabs a:nth-child(1)').removeClass('active');
					$('<li><a href="#trans'+id+'" data-toggle="tab" id="#trans'+id+'" class="nav-link itab'+id+'">'+
					  'Transaksi Baru &nbsp;&nbsp;&nbsp;<span class="text text-danger" onclick="close_tab('+id+')"'+
            'id="close_tab'+id+'"><i class="fas fa-lg fa-times-circle"></i></span></a></li>').prependTo('#tabs').insertBefore($('.next-button'));
					$(res).appendTo('.tab-content');
					$('#tabs .itab'+id+'').tab('show');
				}
			}
		});
	}

	function view_trans() {
		var data = table.row(".selected").data();
		var id = data["id"];
		var no_tiket = data['no_tiket'];
		var element_trans = document.getElementById("#trans"+id);
		$.ajax({
			type:"GET",
			url: "transaction/view/" + id,
			success: function(res) {
				if (element_trans !== null) {
					$('#tabs .itab'+id+'').tab('show');
					return false;
				} else if (id === ''){
					return false;
				} else {
					$('#tabs a:nth-child(1)').removeClass('active');
					$('<li><a href="#trans'+id+'" data-toggle="tab" id="#trans'+id+'" class="nav-link itab'+id+'">'+
							'Transaksi #'+no_tiket+'&nbsp;&nbsp;&nbsp;<span class="text text-danger" onclick="close_tab('+id+')" id="close_tab'+id+'"><i class="fas fa-lg fa-times-circle"></i></span></a></li>').prependTo('#tabs').insertBefore($('.next-button'));
					$(res).appendTo('.tab-content').insertBefore($('#trans0'));
					$('#tabs .itab'+id+'').tab('show');
				}
			}
		});
	}

  function process_data(val) {
    var data = table.row(".selected").data();
    var id = data["id"];
    $.ajax({
      type:"GET",
      url: val + "/"+id+"/process",
      success: function(res) {
        $('#modal_' + val).html(res);
        $('#modal_' + val).modal('show');
      },
      error: function(data){
        error = data.responseJSON.message;
        swal('Error',error,'error');
        console.log(data);
      }
    })
  }

  function cancel_data(val) {
    data = table.row(".selected").data();
    var id = data['id'];
    if(id == undefined || null) {
      var id = data["name"];
    }
    swal({
      title: 'Apakah anda yakin membatalkan '+ val +' ?',
      text: "Kemungkinan data tidak dapat dikembalikan setelah dibatalkan!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: 'Ya, Saya Yakin!',
    }).then((result) => {
      if (result.value) {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
          type:"DELETE",
          url: val + "/"+id+"/cancel",
          success: function(data){
            $(".btn_action").attr("hidden","true");
            reload_data();
            console.log(data);
          },
          error: function(data){
            error = data.responseJSON.message;
            swal('Error',error,'error');
            console.log(data);
          }
        }).done(function(data){
          swal({type: 'success',title: 'Data dibatalkan',showConfirmButton: false,timer: 1500});
          $.gritter.add({title:"Data dibatalkan!",text:"Anda membatalkan data " + val});
          if(val == 'transaction') {
            close_tab(id);
          }
        })
      }
    })
  }

  function destroy_data(val) {
    data = table.row(".selected").data();
    var id = data['id'];
    if(id == undefined || null) {
      var id = data["name"];
    }
    swal({
      title: 'Apakah anda yakin menghapus '+ val +' ?',
      text: "Kemungkinan data tidak dapat dikembalikan setelah dihapus!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: 'Ya, Saya Yakin!',
    }).then((result) => {
      if (result.value) {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
          type:"DELETE",
          url: val + "/"+id+"/destroy",
          success: function(data){
            $(".btn_action").attr("hidden","true");
            reload_data();
            console.log(data);
          },
          error: function(data){
            if(data.responseJSON.message == 'Call to a member function forcedelete() on null') {
              swal('Warning','Data tidak ditemukan atau telah dihapus','warning');
            } else {
              error = data.responseJSON.message;
              swal('Error',error,'error');
              // console.log(data);
            }
          }
        }).done(function(data){
          swal({type: 'success',title: 'Data dihapus',showConfirmButton: false,timer: 1500});
          $.gritter.add({title:"Data dihapus!",text:"Anda menghapus data " + val});
          if(val == 'transaction') {
            close_tab(id);
          }
        })
      }
    })
  }

  function generate_no_trans(val) {
    // var data = table.row(".selected").data();
    // var id = data["id"];
    $.ajax({
      type:"GET",
      url: val + "/generate_no_trans",
      success: function(res) {
        swal('success','No Transaksi di generate','success');
        reload_data();
      },
      error: function(data){
        error = data.responseJSON.message;
        swal('Error',error,'error');
      }
    })
  }

	function close_tab(id) {
		var idx = $('#tabs [id=close_tab'+id+']').parent().get(0).id;
		var anchor = $('#tabs [id=close_tab'+id+']').siblings('a');
		$('.tab-pane' + idx).remove();
		$('#tabs a:eq(1)').tab('show');
		$(anchor.attr('href')).remove();
		$('#tabs [id=close_tab'+id+']').closest('li').remove();
		return false;
	}
</script>
