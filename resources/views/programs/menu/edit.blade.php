<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-warning">
      <h4 class="modal-title text-white">Edit {{ $title }}</h4>
      <span class="close input-group-addon bg-red text-white" id="clear_search" data-dismiss="modal" aria-hidden="true">
        <span class="fas fa-times fa-lg"></span>
      </span>
    </div>
    <div class="modal-body">
      {{ Form::model($menu, ['method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-edit-'.$uri ]) }}
      <div class="alert alert-danger fade show" role="alert" hidden>
        <h5><i class="fa fa-info-circle"></i> ERROR</h5>
        <div id="alert"></div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Active</label>
        <div class="col-md-9">
          <input type="checkbox" class="js-switch" name="active" value="1" @if($menu->active === 1) checked @endif />
        </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Order</label>
        <div class="col-md-9">
          {{ Form::number('order', null, ['placeholder' => 'Order','class' => 'form-control', 'min' => '0']) }}
        </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Name</label>
        <div class="col-md-9">
          {{ Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) }}
        </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Url</label>
        <div class="col-md-9">
          {{ Form::text('url', null, array('placeholder' => 'Url','class' => 'form-control')) }}
        </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Parent</label>
        <div class="col-md-9">
          {{ Form::select('parent' ,['' => '-- No Parent --'] + $parent,$menuParent, ['class' => 'form-control selectpicker dropup', 'size' => '5', 'data-live-search' => 'true', 'data-style' => 'btn-white', 'data-header'=> 'Select Parent', 'data-toggle'=>'ajax']) }}
        </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Icon</label>
        <div class="col-md-9">
          <div class="btn-group">
            <button data-selected="graduation-cap" type="button" class="icp icp-dd btn btn-default dropdown-toggle iconpicker-component" data-toggle="dropdown" style="font-size: 16px">
              <span class="text-theme"><i class="{{ $menu->icon }}"></i></span>
            </button>
            <div class="dropdown-menu"></div>
          </div>
          <input type="hidden" name="icon" id="icon" value="{{ $menu->icon }}">
        </div>
      </div>

    </div>
    {{ Form::close() }}
    <div class="modal-footer">
      <button type="button" class="btn btn-warning" id="btn-save" onclick="update_data('{{ $uri }}')">Update</button>
    </div>
  </div>
</div>
<script type="text/javascript">
  $.getScript('{{ asset("plugins/bootstrap-select/bootstrap-select.min.js") }}').done(function() {
  $.when(
    $.getScript('{{ asset("plugins/switchery/switchery.min.js") }}'),
    $.getScript('{{ asset("plugins/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min.js") }}'),
    $.Deferred(function( deferred ){
      $(deferred.resolve);
    })
  ).done(function() {
    $(".selectpicker").selectpicker("render");
    var elem = document.querySelector('.js-switch');
    var switchery = new Switchery(elem);
    $('.icp-dd').iconpicker({
      title: 'Select Icon Menu',
    });
    $('.icp-dd').on('iconpickerSelected', function (e) {
      $('#icon').val(e.iconpickerValue);
    });
  });
});
</script>
