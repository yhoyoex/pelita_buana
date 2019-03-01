<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-primary">
      <h4 class="modal-title text-white">Tambah {{ $title }}</h4>
      <span class="close input-group-addon bg-red text-white" id="clear_search" data-dismiss="modal" aria-hidden="true">
        <span class="fas fa-times fa-lg"></span>
      </span>
    </div>
    <div class="modal-body">
      {{ Form::open(array('class' => 'form-horizontal','method'=>'POST', 'id' => 'form-tambah-'.$uri)) }}
        <div class="alert alert-danger fade show" role="alert" hidden>
          <h5><i class="fa fa-info-circle"></i> ERROR</h5>
          <div id="alert"></div>
        </div>

        <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">Nama</label>
          <div class="col-md-9">
            {{ Form::text('name', null, array('placeholder' => 'Nama','class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">Nama Tampilan</label>
          <div class="col-md-9">
            {{ Form::text('display_name', null, array('placeholder' => 'Nama Tampilan','class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group row m-b-15">
          <label class="col-form-label col-md-3">Deskripsi</label>
          <div class="col-md-9">
            {{ Form::textarea('description', null, array('placeholder' => 'Deskripsi','class' => 'form-control','style'=>'height:100px')) }}
          </div>
        </div>

        <div class="form-group row m-b-15">
          <label class="col-form-label col-md-12">Hal Akses</label>
        </div>

        <div id="accordion" class="card-accordion">
          @foreach($menu as $item)
            <!-- begin card -->
            <div class="card">
              <div class="card-header bg-theme pointer-cursor" data-toggle="collapse" data-target="#{{ str_replace(' ', '_', $item->name) }}">
                {{ $item->name }}
              </div>
              <div id="{{ str_replace(' ', '_', $item->name) }}" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <div class="form-group row m-b-10">
                    @foreach($item->permission as $permission )
                    <div class="col-md-4">
                      <div class="checkbox checkbox-css checkbox-inline">
                        <input type="checkbox" name="permission[]" value="{{ $permission->id }}" id="{{ $permission->name }}"/>
                        <label for="{{ $permission->name }}" data-toggle="tooltip" data-placement="top" title="{{ $permission->description }}">{{ $permission->display_name }}</label>
                      </div>
                    </div>
                    @endforeach
                  </div>
                  @if(count($item->children))
                    <hr>
                    @foreach($item->children as $children)
                      <span class="text-theme"><strong>{{ $children->name }}</strong></span>
                        <div class="form-group row m-b-10">
                          @foreach($children->permission as $permission )
                          <div class="col-md-4">
                            <div class="checkbox checkbox-css checkbox-inline">
                              <input type="checkbox" name="permission[]" value="{{ $permission->id }}" id="{{ $permission->name }}"/>
                              <label for="{{ $permission->name }}" data-toggle="tooltip" data-placement="top" title="{{ $permission->description }}">{{ $permission->display_name }}</label><a href="#"></a>
                            </div>
                          </div>
                          @endforeach
                        </div>
                      <hr>
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
            <!-- end card -->
          @endforeach
        </div>
      {{ Form::close() }}
    </div>
    <div class="modal-footer">
     <button class="btn btn-primary" onclick="save_data('{{ $uri }}')">Simpan</button>
   </div>
  </div>
</div>
<script>
  $(function () {
    $("[data-toggle='tooltip']").tooltip();
  });
</script>
