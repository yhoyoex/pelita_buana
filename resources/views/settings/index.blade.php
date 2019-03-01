{{-- ================== BEGIN PAGE LEVEL CSS STYLE ================== --}}
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
<link href="{{ asset('plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
{{-- ================== END PAGE LEVEL CSS STYLE ================== --}}

<div class="row">
  <div class="col-md-9">
    <div class="panel panel-inverse panel-with-tabs panel-hover-icon">
      <div class="panel-heading p-0">
        <div class="panel-heading-btn m-r-10 m-t-10">
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        </div>
        <div class="tab-overflow">
          <ul class="nav nav-tabs nav-tabs-inverse">
            <li class="nav-item prev-button"><a href="javascript:;" data-click="prev-tab" class="nav-link text-success"><i class="fa fa-arrow-left"></i></a></li>
            <li class="nav-item"><a href="#app_settings" data-toggle="tab" class="nav-link active">SETTINGS</a></li>
            <li class="nav-item next-button"><a href="javascript:;" data-click="next-tab" class="nav-link text-success"><i class="fa fa-arrow-right"></i></a></li>
          </ul>
        </div>
      </div>

      <div class="tab-content">
        <div class="tab-pane fade active show" id="app_settings">
          <div class="table-responsive">
            <table class="table table-profile">
              <tbody>
                <tr><td colspan="2"><strong>APLICATION SETTING</strong></td></tr>
                <tr class="highlight">
                  <td class="bg-silver-lighter field text-nowrap"><strong>Aplication name</strong></td>
                  <td>
                    <a href="javascript:;" class="editable" name="app_name" id="app_name" data-type="text" data-rows="2" data-pk="1" data-url="{{route('settings.update')}}">{{ Settings::get_settings('app_name') }}</a>
                  </td>
                </tr>
                <tr class="highlight">
                  <td class="bg-silver-lighter field text-nowrap"><strong>Application Description</strong></td>
                  <td><a href="javascript:;" class="editable" name="app_desc" id="app_desc" data-type="text" data-rows="2" data-pk="1" data-url="{{route('settings.update')}}">{{ Settings::get_settings('app_desc') }}</a></td>
                </tr>
                <tr class="highlight">
                  <td class="bg-silver-lighter field text-nowrap"><strong>Application Company</strong></td>
                  <td><a href="javascript:;" class="editable" name="app_desc" id="app_desc" data-type="text" data-rows="2" data-pk="1" data-url="{{route('settings.update')}}">{{ Settings::get_settings('app_company') }}</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="panel panel-inverse panel-hover-icon">
      <div class="panel-heading">
        <div class="panel-heading-btn">
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
        <h4 class="panel-title">Version</h4>
      </div>
      {{-- <div class="panel-body"> --}}
        <table class="table">
          <tr>
            <td width="1%" class="text-nowrap">App Version</td>
            <td><strong>@version('compact')</strong></td>
          </tr>
          <tr>
            <td width="1%" class="text-nowrap">Laravel Version</td>
            <td><strong>v.{{ App::VERSION() }}</strong></td>
          </tr>
        </table>
        <div align="center" class="m-b-20">
          <button type="button" class="btn btn-primary m-b-15 m-t-10">Check Update</button>
        </div>
        {{-- <div class="m-b-15"><span><strong>App Version : </strong></span></div> --}}
        {{-- <div class="m-b-15"><span><strong>Admin Version : </strong></span></div> --}}
        {{-- <div class="m-b-15"><span><strong>Laravel Version : </strong>{{ App::VERSION() }}</span></div> --}}
      </div>
    </div>
  </div>
</div>

{{-- ================== BEGIN PAGE LEVEL JS ================== --}}
<script>
  App.setPageTitle('{{ Settings::get_settings('app_name') }} | {{ $title }}' );
  App.restartGlobalFunction();
  $.getScript('{{ asset("plugins/bootstrap-sweetalert/sweetalert.js") }}'),
  $.getScript('{{ asset("plugins/gritter/js/jquery.gritter.js") }}'),
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
      $('#koneksi_printer').editable({
        source: [
          {value: 'CUPS', text: 'CUPS'},
          {value: 'Recta', text: 'Recta'}
        ]
      });
      $('.editable').editable({
        success: function() {
          // location.reload();
        }
      });


    });
  });
</script>
<!-- ================== END PAGE LEVEL JS ================== -->
