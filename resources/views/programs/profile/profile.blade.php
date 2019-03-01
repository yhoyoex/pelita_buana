
<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
<link href="{{ asset('plugins/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/bootstrap3-editable/inputs-ext/address/address.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/bootstrap3-editable/inputs-ext/typeaheadjs/lib/typeahead.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/bootstrap3-editable/inputs-ext/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/bootstrap3-editable/inputs-ext/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/bootstrap3-editable/inputs-ext/bootstrap-datetimepicker/css/datetimepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/bootstrap3-editable/inputs-ext/select2/select2.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/bootstrap3-editable/inputs-ext/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/superbox/css/superbox.min.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/lity/dist/lity.min.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/jquery-filestyle/jquery-filestyle.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL CSS STYLE ================== -->

<div class="profile">
  <div class="profile-header">
    <div class="profile-header-cover"></div>
    <div class="profile-header-content">
      <div class="profile-header-img">
        <img src="{{ asset('photo/'.Auth::user()->photo) }}" alt="">
      </div>
      <div class="profile-header-info">
        <h4 class="m-t-10 m-b-5">{{ Auth::user()->name }}</h4>
        <p class="m-b-10">{{ Auth::user()->roles[0]->display_name }}</p>
        <input type="file" name="image" id="image" class="jfilestyle" data-input="false" data-buttonName="btn-primary" data-badge="true" data-size="sm" data-buttonText="Ganti Photo">
      </div>
    </div>
    <ul class="profile-header-tab nav nav-tabs" style="width: 100%">
      <li class="nav-item"><a href="#profile-about" class="nav-link active" data-toggle="tab">ABOUT</a></li>
      <li class="nav-item"><a href="#profile-post" class="nav-link" data-toggle="tab">ACTIVITY</a></li>
    </ul>
  </div>
</div>
<div class="profile-content">
  <div class="tab-content p-0">
    <div class="tab-pane fade  show active" id="profile-about">
      <div class="table-responsive">
        <table class="table table-profile">
          <thead>
              <tr>
                <th></th>
                <th>
                  <h4>{{ Auth::user()->name }} <small>{{ Auth::user()->username }}</small></h4>
                </th>
              </tr>
          </thead>
          <tbody>
            <tr class="highlight">
              <td class="field">Name</td>
              <td><a href="javascript:;" name="name" id="name" data-type="text" data-pk="1" data-url="{{ route('update_field') }}">{{ Auth::user()->name }}</a></td>
            </tr>
            <tr class="highlight">
              <td class="field">Username</td>
              <td><a href="javascript:;" name="username" id="username" data-type="text" data-pk="1" data-url="{{ route('update_field') }}">{{ Auth::user()->username }}</a></td>
            </tr>
            <tr class="highlight">
              <td class="field">Role</td>
              <td>{{ Auth::user()->roles[0]->display_name }}</td>
            </tr>
            <tr class="highlight">
              <td class="field">Email</td>
              <td><a href="javascript:;" name="email" id="email" data-type="text" data-pk="1" data-title="Email" data-url="{{ route('update_field') }}">{{ Auth::user()->email }}</a></td>
            </tr>
            <tr class="highlight">
              <td class="field">No. HP</td>
              <td><a href="javascript:;" name="contact" id="contact" data-type="text" data-pk="1" data-title="Contact" data-url="{{ route('update_field') }}">{{ Auth::user()->contact }}</a></td>
            </tr>
            <tr class="highlight">
              <td class="field">Password</td>
              <td><a href="javascript:;" class="btn btn-sm btn-theme" onclick="show_modal_password()">Ganti Password</a></td>
            </tr>
            <tr class="highlight">
              <td class="field">Last Login</td>
              <td>{{ \Carbon\Carbon::parse(Auth::user()->previous_visit_at)->diffForHumans() }}</td>
            </tr>
            <tr class="highlight">
              <td class="field">Last IP</td>
              <td>{{ Auth::user()->previous_visit_ip }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal fade" id="modal_password" tabindex="-1" role="dialog" aria-labelledby="modal_password" aria-hidden="true"></div>
    </div>
    <div class="tab-pane fade in" id="profile-post">
      <ul class="timeline">
        @foreach($log as $key => $activity)
        <li>
          <div class="timeline-time">
              <span class="date">{{ Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</span>
              <span class="time">{{ Carbon\Carbon::parse($activity->created_at)->format('H:i') }}</span>
          </div>
          <div class="timeline-icon">
            <a href="javascript:;">&nbsp;</a>
          </div>
          <div class="timeline-body">
            <div class="timeline-header">
                @if ($activity->description === 'created')
                  <span class="username text-primary">{{ ucfirst(trans($activity->description)) }}<small></small></span>
                @elseif($activity->description === 'updated')
                  <span class="username text-warning">{{ ucfirst(trans($activity->description)) }}<small></small></span>
                @elseif($activity->description === 'deleted')
                  <span class="username text-danger">{{ ucfirst(trans($activity->description)) }}<small></small></span>
                @else
                  <span class="username">{{ ucfirst(trans($activity->description)) }}<small></small></span>
                @endif
                <span class="pull-right ">{{ $activity->subject_type }}</span>
            </div>
              <div class="timeline-content">
                <div class="row">
                  @foreach ($activity->properties as $key => $properties)
                    <div class="col-md-6">
                      @if($key === "attributes")
                        <strong><span>Data :</span></strong><br>
                      @elseif($key === "old")
                        <strong><span>Old Data :</span></strong><br>
                      @else
                        <strong>{{ ucfirst(trans($key)) }} :</strong><br>
                      @endif
                    @foreach ($properties as $key => $log)
                      <small><span style="padding-left: 20px">{{ $key .' = '. $log }} </span></small><br>
                    @endforeach
                    <br>
                    </div>
                  @endforeach
                </div>
              </div>
          </div>
        </li>
        @endforeach
      </ul>
      <div class="row h-100 justify-content-center align-items-center">
        @if($count > $limit)
        <input type="hidden" name="offset" id="offset" value="{{ $limit }}">
        <div class="btn btn-theme" id="load_more" onclick="load_more_activity()">Load More</div>
        @elseif($count == 0)
        <h4>-- No Activity --</h4>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script>
  App.setPageTitle('{{ Settings::get_settings('app_name') }} | {{ $title }}' );
  App.setPageOption({
    pageContentFullWidth: true,
    clearOptionOnLeave: true,
  });
  App.restartGlobalFunction();
  $.getScript('{{ asset("plugins/bootstrap3-editable/js/bootstrap-editable.min.js") }}').done(function() {
    $.when(
      $.getScript('{{ asset("plugins/bootstrap3-editable/inputs-ext/address/address.js") }}'),
      $.getScript('{{ asset("plugins/bootstrap3-editable/inputs-ext/typeaheadjs/lib/typeahead.js") }}'),
      $.getScript('{{ asset("plugins/bootstrap3-editable/inputs-ext/typeaheadjs/typeaheadjs.js") }}'),
      $.getScript('{{ asset("plugins/bootstrap3-editable/inputs-ext/bootstrap-wysihtml5/wysihtml5.js") }}'),
      $.getScript('{{ asset("plugins/bootstrap3-editable/inputs-ext/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js") }}'),
      $.getScript('{{ asset("plugins/bootstrap3-editable/inputs-ext/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js") }}'),
      $.getScript('{{ asset("plugins/bootstrap3-editable/inputs-ext/bootstrap-datepicker/js/bootstrap-datepicker.js") }}'),
      $.getScript('{{ asset("plugins/bootstrap3-editable/inputs-ext/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js") }}'),
      $.getScript('{{ asset("plugins/bootstrap3-editable/inputs-ext/select2/select2.min.js") }}'),
      $.getScript('{{ asset("plugins/mockjax/jquery.mockjax.js") }}'),
      $.getScript('{{ asset("plugins/moment/moment.min.js") }}'),
      $.getScript('{{ asset("plugins/superbox/js/jquery.superbox.min.js") }}'),
      $.getScript('{{ asset("plugins/lity/dist/lity.min.js") }}'),
      $.getScript('{{ asset("plugins/jquery-filestyle/jquery-filestyle.js") }}'),
      $.Deferred(function( deferred ){
        $(deferred.resolve);
      })
    ).done(function() {
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.fn.editable.defaults.mode="inline";
      $.fn.editable.defaults.inputclass="form-control input-sm";
      $('#name').editable();
      $('#username').editable();
      $('#email').editable();
      $('#contact').editable();

      $('#image').on('change', function(){
        var name = $('#image')[0].files[0].name;
        var ext = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
          alert("File tidak berekstensi fle gambar");
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL($('#image')[0].files[0]);
        var f = $('#image')[0].files[0];
        var fsize = f.size||f.fileSize;
        if(fsize > 2000000) {
            alert("File gambar terlalu besar");
        } else {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          var image = $('#image')[0].files[0];
          var form_data = new FormData();
          form_data.append('image', image);
          form_data.append('ext', ext);
        $.ajax({
          type: 'POST',
          url: 'profile/photo/store',
          data: form_data,
          cache: false,
          contentType: false,
          processData: false,
          success:function(response) {
            location.reload();
          }
        });
        }
      });
    });
  });
  function show_modal_password() {
    $.ajax({
      type:"GET",
      url: "profile/update_password",
      success: function(res) {
        $('#modal_password').html(res);
        $('#modal_password').modal('show');
      }
    });
  }

  function save_password(){
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
      type:"POST",
      url:'profile/store_password',
      data:$('#form-password').serialize(),
      dataType: 'json',
      success: function(data){
        $('#modal_password').modal('hide');
        $.gritter.add({title:"Password Updated!",text:"Your Success Update Your Password."});
      },
      error: function(data){
        console.log(data);
        $('#alert').html('');
        if(data.status == 422) {
          $('.alert').removeAttr('hidden');
          for (var error in data.responseJSON.errors) {$('#alert').append(data.responseJSON.errors[error]+'<br>')};
        } else {
          $('#alert').append('Someting wrong, please contact administrator');
        }
      }
    })
  }

  function load_more_activity() {
    var offset = $('#offset').val();
    var offsets = parseInt(offset) + parseInt({{ $limit }});
    $.ajax({
      type:"GET",
      url: "profile/load-activity/" + offset,
      success: function(res) {
        $('.timeline').append(res);
        $('#offset').val(offsets);
        if($('#offset').val() > {{ $count }}) {
          $('#load_more').attr("hidden","true");
        }
      }
    });
  }
</script>
<!-- ================== END PAGE LEVEL JS ================== -->
