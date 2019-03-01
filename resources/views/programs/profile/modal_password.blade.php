<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-warning">
      <h4 class="modal-title text-white">Update Password</h4>
      <span class="close input-group-addon bg-red text-white" id="clear_search" data-dismiss="modal" aria-hidden="true">
        <span class="fas fa-times fa-lg"></span>
      </span>
    </div>
    <div class="modal-body">
      {{ Form::open(['class' => 'form-horizontal', 'id' => 'form-password']) }}

      <div class="alert alert-danger fade show" role="alert" hidden>
        <h5><i class="fa fa-info-circle"></i> ERROR</h5>
        <div id="alert"></div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-4">Current Password</label>
        <div class="col-md-8">
          {{ Form::password('current_password', ['placeholder' => 'Current Password','class' => 'form-control']) }}
        </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-4">New Password</label>
        <div class="col-md-8">
          {{ Form::password('new_password', ['placeholder' => 'New Password','class' => 'form-control m-b-10','id' => 'password-indicator-default', 'autocomplete' => 'off']) }}
          <span toggle="#password-indicator-default" class="fa fa-fw fa-eye fa-lg field-icon-password toggle-password"></span>
          <div id="passwordStrengthDiv" class="is0 m-t-5"></div>
        </div>
      </div>

      <div class="form-group row m-b-15">
        <label class="col-form-label col-md-4">Confirm Password</label>
        <div class="col-md-8">
          {{ Form::password('confirm-password', ['placeholder' => 'Confirm Password','class' => 'form-control', 'id' => 'password-indicator-confirm', 'autocomplete' => 'off']) }}
          <span toggle="#password-indicator-confirm" class="fa fa-fw fa-eye fa-lg field-icon-confirm toggle-password"></span>
        </div>
      </div>
      {{ Form::close() }}
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" onclick="save_password()">Update</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $.when(
      $.getScript('{{ asset("plugins/password-indicator/js/password-indicator.js") }}'),
      ).done(function() {
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
    });
</script>
