<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-danger">
        <h4 class="modal-title text-white">Lapor Masalah System</h4>
        <span class="close input-group-addon bg-red text-white" id="clear_search" data-dismiss="modal" aria-hidden="true">
          <span class="fas fa-times fa-lg"></span>
        </span>
    </div>
    <div class="modal-body">
      {{ Form::open(['id' => 'form-bugs-report']) }}
        <div class="alert alert-danger fade show" role="alert" hidden>
          <h5><i class="fa fa-info-circle"></i> ERROR</h5>
          <div id="alert"></div>
        </div>

        <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">Judul</label>
          <div class="col-md-9">
            {{ Form::text('subject', null, ['placeholder' => 'Judul masalah','class' => 'form-control','required']) }}
          </div>
        </div>

        <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">Keterangan</label>
          <div class="col-md-9">
            {{ Form::textarea('desc', null, ['placeholder' => 'Keterangan masalah pada system','class' => 'form-control', 'size' => '30x10']) }}
          </div>
        </div>
        {{ Form::close() }}
    </div>
    <div class="modal-footer">
      <a href="javascript:;" class="btn btn-danger" id="btn-save" onclick="save_bugs_report()">Laporkan</a>
    </div>
  </div>
</div>
