<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-primary">
      <h4 class="modal-title text-white">Tambah {{ $title }}</h4>
      <span class="close input-group-addon bg-red text-white" id="clear_search" data-dismiss="modal" aria-hidden="true">
        <span class="fas fa-times fa-lg"></span>
      </span>
    </div>
    <div class="modal-body">
      {{ Form::open(['class' => 'form-horizontal', 'id' => 'form-tambah-'.$uri]) }}
      <div class="alert alert-danger fade show" role="alert" hidden>
        <h5><i class="fa fa-info-circle"></i> ERROR</h5>
        <div id="alert"></div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Active</label>
        <div class="col-md-9">
          <input type="checkbox" class="js-switch" name="active" value="1" />
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
          {{ Form::text('name', null, ['placeholder' => 'Name','class' => 'form-control']) }}
        </div>
      </div>


      <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">Url</label>
          <div class="col-md-9">
            {{ Form::text('url', null, ['placeholder' => 'Url','class' => 'form-control']) }}
          </div>
      </div>

      <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">Parent</label>
          <div class="col-md-9">
            {{ Form::select('parent', ['' => '-- No Parent --'] + $parent,[], ['class' => 'form-control selectpicker dropup', 'size' => '5', 'data-live-search' => 'true', 'data-style' => 'btn-white', 'data-header'=> 'Select Parent', 'data-toggle'=>'ajax']) }}
          </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Icon</label>
        <div class="col-md-9">
          <div class="btn-group">
            <button data-selected="graduation-cap" type="button" class="icp icp-dd btn btn-default dropdown-toggle iconpicker-component" data-toggle="dropdown" style="font-size: 16px">
              <span class="text-theme"><i></i></span>
            </button>
            <div class="dropdown-menu"></div>
          </div>
          <input type="hidden" name="icon" id="icon">
        </div>
      </div>
      {{ Form::close() }}
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-save" onclick="save_data('{{ $uri }}')">Simpan</button>
      </div>
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
