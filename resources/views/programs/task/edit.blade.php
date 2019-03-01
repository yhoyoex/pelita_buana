<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-warning">
      <h4 class="modal-title text-white">Edit {{ $title }}</h4>
      <span class="close input-group-addon bg-red text-white" id="clear_search" data-dismiss="modal" aria-hidden="true">
        <span class="fas fa-times fa-lg"></span>
      </span>
    </div>
    <div class="modal-body">
      {{ Form::model($task, ['method' => 'PATCH', 'id' => 'form-edit-'.$uri]) }}
      <div class="alert alert-danger fade show" role="alert" hidden>
        <h5><i class="fa fa-info-circle"></i> ERROR</h5>
        <div id="alert"></div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Subject</label>
        <div class="col-md-9">
          {{ Form::text('subject', null, ['placeholder' => 'Subject','class' => 'form-control','required']) }}
        </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Description</label>
        <div class="col-md-9">
          {{ Form::textarea('desc', null, ['placeholder' => 'Description','class' => 'form-control', 'size' => '30x10']) }}
        </div>
      </div>

     <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Type</label>
        <div class="col-md-9">
          {{ Form::select('type', ['bugs' => 'Bugs','development' => 'Development'], $task_type, ['class' => 'form-control selectpicker dropup', 'size' => '5', 'data-style' => 'btn-white', 'data-toggle'=>'ajax', 'id' => 'type']) }}
        </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Status</label>
        <div class="col-md-9">
          {{ Form::select('status',['uncomplete' => 'Uncomplete', 'on progress' => 'On Progress', 'complete' => 'Complete'],$task_status, ['class' => 'form-control selectpicker dropup', 'size' => '5', 'data-style' => 'btn-white', 'data-toggle'=>'ajax', 'id' => 'province']) }}
        </div>
      </div>

    {{ Form::close() }}
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-warning" onclick="update_data('{{ $uri }}')">Update</button>
  </div>
</div>
</div>
<script>
  $.getScript('{{ asset("plugins/bootstrap-select/bootstrap-select.min.js") }}').done(function() {
    $.when(
      $.Deferred(function( deferred ){
        $(deferred.resolve);
      })
    ).done(function() {
      $(".selectpicker").selectpicker("render");
    })
  })
  $('#name').keyup(function() {
    this.value = this.value.toUpperCase();
  });
</script>
