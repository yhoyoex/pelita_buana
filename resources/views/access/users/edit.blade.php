<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-warning">
      <h4 class="modal-title text-white">Edit {{ $title }}</h4>
      <span class="close input-group-addon bg-red text-white" id="clear_search" data-dismiss="modal" aria-hidden="true">
        <span class="fas fa-times fa-lg"></span>
      </span>
    </div>
    <div class="modal-body">
      {{ Form::model($user, ['method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form-edit-'.$uri]) }}
      <div class="alert alert-danger fade show" role="alert" hidden>
        <h5><i class="fa fa-info-circle"></i> ERROR</h5>
        <div id="alert"></div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Active</label>
        <div class="col-md-9">
          <input type="checkbox" class="js-switch" name="active" value="1" @if($user->active === 1) checked @endif />
        </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Name</label>
        <div class="col-md-9">
          {{ Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) }}
        </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Username</label>
        <div class="col-md-9">
          {{ Form::text('username', null, array('placeholder' => 'Username','class' => 'form-control')) }}
        </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Email</label>
        <div class="col-md-9">
          {{ Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) }}
        </div>
      </div>

      <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">No. HP</label>
          <div class="col-md-9">
            {{ Form::text('contact', null, array('placeholder' => 'No. HP ','class' => 'form-control')) }}
          </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Password</label>
        <div class="col-md-9">
          {{ Form::password('password', ['placeholder' => 'Password','class' => 'form-control m-b-10','id' => 'password-indicator-default']) }}
          <span toggle="#password-indicator-default" class="fa fa-fw fa-eye fa-lg field-icon-password toggle-password"></span>
          <div id="passwordStrengthDiv" class="is0 m-t-5"></div>
        </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Confirm Password</label>
        <div class="col-md-9">
          {{ Form::password('confirm-password', ['placeholder' => 'Confirm Password','class' => 'form-control','id' => 'password-indicator-confirm']) }}
          <span toggle="#password-indicator-confirm" class="fa fa-fw fa-eye fa-lg field-icon-confirm toggle-password"></span>
        </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-3">Role</label>
        <div class="col-md-9">
          {{ Form::select('roles', $roles,$userRole, ['class' => 'form-control selectpicker dropup', 'size' => '5', 'data-live-search' => 'true', 'data-style' => 'btn-white', 'data-header'=> 'Pilih Role', 'data-toggle'=>'ajax']) }}
        </div>
      </div>
    </div>
    {{ Form::close() }}
    <div class="modal-footer">
      <button class="btn btn-warning" id="btn-save" onclick="update_data('{{ $uri }}')">Update</button>
    </div>
  </div>
</div>
<script type="text/javascript">
  $.getScript('{{ asset("plugins/bootstrap-select/bootstrap-select.min.js") }}').done(function() {
    $.when(
      $.getScript('{{ asset("plugins/switchery/switchery.min.js") }}'),
      $.getScript('{{ asset("plugins/password-indicator/js/password-indicator.js") }}'),
      $.Deferred(function( deferred ){
        $(deferred.resolve);
      })
    ).done(function() {
      $(".selectpicker").selectpicker("render");
      var elem = document.querySelector('.js-switch');
      var switchery = new Switchery(elem);
      $("#password-indicator-default").passwordStrength();
      $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
    })
  })
</script>
