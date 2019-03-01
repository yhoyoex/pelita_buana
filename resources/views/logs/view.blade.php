<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header
      @if($log->description == 'created')
        bg-primary
      @elseif($log->description == 'updated')
        bg-warning
      @elseif($log->description == 'deleted')
        bg-danger
      @endif
    ">
      <h4 class="modal-title text-white">Detail Log</h4>
        <span class="close input-group-addon bg-red text-white" id="clear_search" data-dismiss="modal" aria-hidden="true">
          <span class="fas fa-times fa-lg"></span>
        </span>
    </div>
    <div class="modal-body">
      <div class="float-right">
        @if($log->description == 'created')
          <h5><span class="text-primary">{{ strtoupper($log->description) }}</span></h5>
        @elseif($log->description == 'updated')
          <h5><span class="text-warning">{{ strtoupper($log->description) }}</span></h5>
        @elseif($log->description == 'deleted')
          <h5><span class="text-danger">{{ strtoupper($log->description) }}</span></h5>
        @endif
      </div>
      @foreach ($log_properties as $key => $log)
        <span class="text-theme"><strong>{{ strtoupper($key) }} : </strong></span><br>
        @foreach ($log as $key => $logs)
          <span style="padding-left: 20px">{{ $key .' = '. $logs }} </span><br>
        @endforeach
        <br>
      @endforeach
    </div>
  </div>
</div>
