<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-warning">
      <h4 class="modal-title text-white">Edit {{ $title }}</h4>
      <span class="close input-group-addon bg-red text-white" id="clear_search" data-dismiss="modal" aria-hidden="true">
        <span class="fas fa-times fa-lg"></span>
      </span>
    </div>
    <div class="modal-body">
      {!! Form::model($karyawan, ['method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-edit-karyawan']) !!}
        <div class="alert alert-danger fade show" role="alert" hidden>
          <h5><i class="fa fa-info-circle"></i> ERROR</h5>
          <div id="alert"></div>
        </div>

        <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">NIK</label>
          <div class="col-md-9">
            {{ Form::text('nik', null, ['placeholder' => 'NIK','class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">Nama</label>
          <div class="col-md-9">
            {{ Form::text('nama', null, ['placeholder' => 'Nama','class' => 'form-control', 'id' => 'nama']) }}
          </div>
        </div>

        <div class="form-group row m-b-15">
          <label class="col-md-3 col-form-label">Gender</label>
          <div id="gender" class="col-md-8">
            <div class="radio radio-css radio-inline">
              <input type="radio" id="laki_laki" name="gender" value="Laki laki" @if($karyawan->gender=="Laki laki") checked="checked" @endif/>
              <label for="laki_laki">Laki laki</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input type="radio" id="perempuan" name="gender" value="Perempuan" @if($karyawan->gender=="Perempuan") checked="checked" @endif/>
              <label for="perempuan">Perempuan</label>
            </div>
          </div>
        </div>

        <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">Alamat</label>
          <div class="col-md-9">
            {{ Form::textarea('alamat', null, ['placeholder' => 'Alamat','class' => 'form-control', 'size' => '30x5']) }}
          </div>
        </div>

        <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">Telp.</label>
          <div class="col-md-9">
            {{ Form::text('tlp', null, ['placeholder' => 'Phone','class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">Jabatan</label>
          <div class="col-md-9">
            {{ Form::select('jabatan', $jabatan, $karyawan->jabatan_id, ['class' => 'form-control selectpicker dropup', 'size' => '5', 'data-live-search' => 'true', 'data-style' => 'btn-white', 'data-toggle'=>'ajax', 'id' => 'jabatan']) }}
          </div>
        </div>
      {{ Form::close() }}
    </div>
    <div class="modal-footer bg-grey-transparent-2">
      <a href="javascript:;" class="btn btn-warning" onclick="update_data('{{ $uri }}')">Update</a>
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
