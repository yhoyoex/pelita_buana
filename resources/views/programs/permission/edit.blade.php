<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-warning">
      <h4 class="modal-title text-white">Edit {{ $title }}</h4>
      <span class="close input-group-addon bg-red text-white" id="clear_search" data-dismiss="modal" aria-hidden="true">
        <span class="fas fa-times fa-lg"></span>
      </span>
    </div>
    <div class="modal-body">
      {{ Form::model($permission, ['method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-edit-'.$uri]) }}
      <div class="alert alert-danger fade show" role="alert" hidden>
        <h5><i class="fa fa-info-circle"></i> ERROR</h5>
        <div id="alert"></div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Name</label>
        <div class="col-md-9">
          {{ Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) }}
        </div>
      </div>

      <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">Display Name</label>
          <div class="col-md-9">
            {{ Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control')) }}
          </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Description</label>
        <div class="col-md-9">
          {!! Form::textarea('description', null, ['placeholder' => 'Description','class' => 'form-control', 'size' => '30x5']) !!}
        </div>
      </div>

      <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">Menu</label>
          <div class="col-md-9">
            {{ Form::select('menu', $menu,$menuPermission, ['class' => 'form-control selectpicker dropup', 'size' => '5', 'data-live-search' => 'true', 'data-style' => 'btn-white', 'data-header'=> 'Select Menu', 'data-toggle'=>'ajax']) }}
          </div>
      </div>
      {{ Form::close() }}
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="btn-save" onclick="update_data('{{ $uri }}')">Update</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(".selectpicker").selectpicker("render");
</script>
