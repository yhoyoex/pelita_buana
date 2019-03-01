function add_data(val) {
  $.ajax({
    type:"GET",
    url: val + '/create',
    success: function(res) {
      $('#modal_'+val).html(res);
      $('#modal_'+val).modal('show');
    },
    error: function(data){
      error = data.responseJSON.message;
      swal('Error',error,'error');
      console.log(data);
    }
  })
}

function save_data(val){
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
    type:"POST",
    url:val + '/store',
    data:$('#form-tambah-' + val).serialize(),
    success: function(data){
      $('#modal_' + val).modal('hide');
      reload_data();
    },
    error: function(data){
      $('#alert').html('');
      if(data.status == 422) {
        $('.alert').removeAttr('hidden');
        for (var error in data.responseJSON.errors) {$('#alert').append(data.responseJSON.errors[error]+'<br>')};
      } else {
        $('#alert').append('Terjadi keslahan system, harap laporkan masalah');
      }
    }
  })
  .done(function(){
    swal({type: 'success',title: 'Data ditambahkan',showConfirmButton: false,timer: 1500});
    $.gritter.add({title:"Data ditambahkan!",text:"Anda berhasil menambahkan data" + val});
  })
}

function view_data(val) {
  var data = table.row(".selected").data();
  var id = data["id"];
  $.ajax({
    type:"GET",
    url: val + "/view/"+id,
    success: function(res) {
      $('#modal_' + val).html('');
      $('#modal_' + val).html(res);
      $('#modal_' + val).modal('show');
    }
  });
}

function show_data(val) {
  var data = table.row(".selected").data();
  var id = data["id"];
}

function edit_data(val) {
  var data = table.row(".selected").data();
  var id = data["id"];
  $.ajax({
    type:"GET",
    url: val + "/"+id+"/edit",
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

function update_data(val){
  var data = table.row(".selected").data();
  var id = data["id"];
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
    type:"PATCH",
    url:val + '/'+id,
    data:$('#form-edit-' + val).serialize(),
    success: function(data){
      $('#modal_' + val).modal('hide');
      reload_data();
    },
    error: function(data){
      $('#alert').html('');
      if(data.status == 422) {
        $('.alert').removeAttr('hidden');
        for (var error in data.responseJSON.errors) {$('#alert').append(data.responseJSON.errors[error]+'<br>')};
      } else {
        error = data.responseJSON.message;
        swal('Error',error,'error');
        console.log(data);
      }
    }
  }).done(function(){
    swal({type: 'success',title: 'Data diupdate',showConfirmButton: false,timer: 1500});
    $.gritter.add({title:"Data diupdate!",text:"Anda mengupdate data " + val});
  })
}

function delete_data(val) {
  data = table.row(".selected").data();
  var id = data['id'];
  if(id == undefined || null) {
    var id = data["name"];
  }
  swal({
    title: 'Apakah anda yakin menghapus data '+ val +' ?',
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
        url:val + '/' + id,
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
        swal({type: 'success',title: 'Data dihapus',showConfirmButton: false,timer: 1500});
        $.gritter.add({title:"Data dihapus!",text:"Anda menghapus data " + val});
        if(val == 'transaction') {
          close_tab(id);
        }
      })
    }
  })
}

function download(val) {
  var data = table.row(".selected").data();
  var name = data["name"];
  $.ajax({
    type:"GET",
    url:val + '/download/'+name,
    success: function(data){
      window.location = val + '/download/'+name;
    },
    error: function(data){
      error = data.responseJSON.message;
      swal('Error',error,'error');
      console.log(data);
    }
  })
}

function reload_data() {
  table.ajax.reload();
}
