<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-primary">
        <h4 class="modal-title text-white">Tambah {{ $title }}</h4>
        <span class="close input-group-addon bg-red text-white" id="clear_search" data-dismiss="modal" aria-hidden="true">
          <span class="fas fa-times fa-lg"></span>
        </span>
    </div>
    <div class="modal-body">
      {{ Form::open(['id' => 'form-tambah-'.$uri]) }}
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
            {{ Form::select('type', ['bugs' => 'Bugs','development' => 'Development'], [], ['class' => 'form-control selectpicker dropup', 'size' => '5', 'data-style' => 'btn-white', 'data-toggle'=>'ajax', 'id' => 'type']) }}
          </div>
        </div>
        {{ Form::close() }}
    </div>
    <div class="modal-footer">
      <button class="btn btn-primary" onclick="save_data('{{ $uri }}')">Simpan</button>
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
</script>
