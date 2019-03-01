@foreach($log as $key => $activity)
<li>
  <!-- begin timeline-time -->
  <div class="timeline-time">
      <span class="date">{{ Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</span>
      <span class="time">{{ Carbon\Carbon::parse($activity->created_at)->format('H:i') }}</span>
  </div>
  <!-- end timeline-time -->
  <!-- begin timeline-icon -->
  <div class="timeline-icon">
    <a href="javascript:;">&nbsp;</a>
  </div>
  <!-- end timeline-icon -->  
  <!-- begin timeline-body -->
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
      <!-- <div class="timeline-footer"></div> -->
  </div>
  <!-- end timeline-body -->
</li>
@endforeach