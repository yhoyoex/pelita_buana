<div class="panel panel-inverse panel-hover-icon">
  <div class="panel-heading">
    <div class="panel-heading-btn">
      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" onclick="reload_data()"><i class="fa fa-redo"></i></a>
      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
    </div>
    <h4 class="panel-title">{{ $title }}</h4>
  </div>
  <div class="panel-toolbar bg-theme">
    @ability('root','')
      <a href="javascript:;" id="btn_new" class="btn btn-primary" onclick="add_data()"><i class="fas fa-plus-circle"></i> Tambah</a>
    @endability
    <div class="float-right btn_action" hidden>
      @ability('root','')
        <a href="javascript:;" id="btn_edit" class="btn btn-warning" onclick="edit_data()"><i class="fas fa-pencil-alt"></i> Edit</a>
      @endability
      @ability('root','')
        <a href="javascript:;" id="btn_delete" class="btn btn-danger" onclick="delete_data()"><i class="fas fa-trash-alt"></i> Delete</a>
      @endability
    </div>
  </div>
  <div class="panel-body">
    <div id="task_total"></div>
    <div class="table-responsive m-t-20">
      <table width="100%" class="table table-bordered table-hover">
        <thead class="bg-theme">
          <tr>
            <th>Tanggal</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>User</th>
            <th>Tipe</th>
            <th>Status</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="modal fade" id="modal_task" tabindex="-1" aria-labelledby="modal_task" aria-hidden="true"></div>
  </div>
</div>
<script>
  App.setPageTitle('{{ Settings::get_settings('app_name') }} | {{ $title }}' );
  App.restartGlobalFunction();
  $.when(
    $.Deferred(function( deferred ){
      $(deferred.resolve);
    })
  ).done(function() {
    getTotal();
    // $.fn.dataTable.ext.errMode = 'none';
    // table = $(".table").length&&$(".table").DataTable({
    //   dom:"lBfrtip",
    //   buttons:[
    //     { extend: 'colvis', className: 'btn-grey' },
    //     { extend: 'excel', className: 'btn-success' },
    //     { extend: 'pdf', className: 'btn-danger' },
    //     { extend: 'print', className: 'btn-primary' },
    //   ],
    //   rowId: 'id',
    //   searchHighlight: true,
    //   processing: false,
    //   serverSide: true,
    //   ajax: {url:'{{ route("task-list.list") }}'},
    //   deferRender: true,
    //   responsive:true,
    //   select: true,
    //   colReorder:!0,
    //   sorting: [[0,"asc"]],
    //   pagingType: "full_numbers",
    //   stateSave: true,
    //   language: {"zeroRecords": "Data not found..."},
    //   lengthMenu: [[10, 20, 30, 50, 100, -1], [10, 20, 30, 50, 100, "All"]],
    //   columns: [
    //     { data: 'created_at', sClass:'text-nowrap'},
    //     { data: 'subject', sClass:'text-nowrap'},
    //     { data: 'desc'},
    //     { data: 'created_by', sClass:'text-nowrap'},
    //     { data: 'type', sClass:'text-center text-nowrap'},
    //     { data: 'status', sClass:'text-center text-nowrap'}
    //   ]
    // });
    // table.on("click","tr",function() {
    //   if ($(this).hasClass("selected")) {
    //     $(".btn_action").removeAttr("hidden");
    //   }
    //   else {
    //     $(".btn_action").attr("hidden","true");
    //   }
    // });
    // table.on("draw",function () {
    //   var body = $(table.table().body());
    //   body.unhighlight();
    //   body.highlight(table.search());
    // });
  });

  function getTotal() {
    $.ajax({
      type:"GET",
      url: "system-logs/get-total",
      success: function(res) {
        $('#task_total').html('');
        $('#task_total').html(res);
      }
    });
  }

  function add_data() {
    $.ajax({
      type:"GET",
      url: "task-list/create",
      success: function(res) {
        $('#modal_task').html(res);
        $('#modal_task').modal('show');
      }
    });
  }

  function edit_data() {
    var data = table.row(".selected").data();
    var id = data["id"];
    $.ajax({
      type:"GET",
      url: "task-list/"+id+"/edit",
      success: function(res) {
        $('#modal_task').html(res);
        $('#modal_task').modal('show');
      }
    });
  }

  function save_data(){
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
      type:"POST",
      url:'task-list/store',
      data:$('#form-task-list-add').serialize(),
      dataType: 'json',
      success: function(data){
        $('#modal_task').modal('hide');
        $.gritter.add({title:"Data Added!",text:"Your Success Add {{ $title }} Data."});
        getTotal();
        reload_data();
      },
      error: function(data){
        $('#alert').html('');
        if(data.status == 422) {
          $('.alert').removeAttr('hidden');
          for (var error in data.responseJSON.errors) {$('#alert').append(data.responseJSON.errors[error]+'<br>')};
        } else {
          $('#alert').append('Someting wrong, please contact administrator');
        }
      }
    })
  };

  function update_data(){
    var data = table.row(".selected").data();
    var id = data["id"];
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type:"PATCH",
      url:'task-list/'+id,
      data:$('#form-edit-task-list').serialize(),
      success: function(data){
        $('#modal_task').modal('hide');
        $.gritter.add({title:"Data Updated!",text:"Your Success Update {{ $title }} Data."});
        getTotal();
        reload_data();
      },
      error: function(data){
        $('#alert').html('');
        if(data.status == 422) {
          $('.alert').removeAttr('hidden');
          for (var error in data.responseJSON.errors) {$('#alert').append(data.responseJSON.errors[error]+'<br>')};
        } else {
          $('#alert').append('Someting wrong, please contact administrator');
        }
      }
    })
  };

  function delete_data() {
    var data = table.row(".selected").data();
    var name = data["name"];
    var id = data["id"];

    swal({
      title: 'Are you sure delete this data ?',
      text: "You won't be able to revert this!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: 'Yes, delete it!',
      closeOnConfirm: false,
    },function() {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
        type:"DELETE",
        url:'task-list/'+id,
        dataType: 'json',
        success: function(data){
          swal.close();
          $.gritter.add({title:"Data Deleted!",text:"Your Success Delete {{ $title }} Data."});
          $(".btn_action").attr("hidden","true");
          getTotal();
          reload_data();
        },
        error: function(data){
          swal('Error','Someting Wrong','error');
        }
      })
    })
  }

  function reload_data() {
    table.ajax.reload();
  }
</script>
