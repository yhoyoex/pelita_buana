
  <div class="row">
    <div class="col-md-8">
      <div class="table-responsive m-b-20">
        <table width="100%" class="table-bordered">
          <tr>
            <td width="25%" class="text-center text-nowrap" style="padding:5px !important">
              <div class="f-s-18"><strong>{{ count($task) }}</strong></div>
              <strong>All</strong>
            </td>
            <td width="25%" class="text-center text-nowrap" style="padding:5px !important">
              <div class="f-s-18"><strong class="text-warning">{{ count($uncomplete_total) }}</strong></div>
              <strong class="text-warning">Uncompleted</strong>
            </td>
            <td width="25%" class="text-center text-nowrap" style="padding:5px !important">
              <div class="f-s-18"><strong class="text-primary">{{ count($progress_total) }}</strong></div>
              <strong class="lab text-primary">On Progress</strong>
            </td>
            <td width="25%" class="text-center text-nowrap" style="padding:5px !important">
              <div class="f-s-18"><strong class="text-success">{{ count($complete_total) }}</strong></div>
              <strong class="text-success">Completed</strong>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <div class="col-md-4">
      <div class="table-responsive m-b-20">
        <table width="100%" class="table-bordered">
          <tr>
            <td width="33%" class="text-center text-nowrap" style="padding:5px !important">
              <div class="f-s-18"><strong class="text-danger">{{ count($bug_total) }}</strong></div>
              <strong class="text-danger">Bugs</strong>
            </td>
            <td width="33%" class="text-center text-nowrap" style="padding:5px !important">
              <div class="f-s-18"><strong class="text-info">{{ count($development_total) }}</strong></div>
              <strong class="text-info">Development</strong>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  

<hr>