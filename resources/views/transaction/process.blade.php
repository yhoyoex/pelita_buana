<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h4 class="modal-title text-white">Proses {{ $title }}</h4>
        <span class="close input-group-addon bg-red text-white" id="clear_search" data-dismiss="modal" aria-hidden="true">
          <span class="fas fa-times fa-lg"></span>
        </span>
      </div>
      <div class="modal-body">
        {{ Form::model($trans, ['method' => 'PATCH','class' => 'form-horizontal', 'id' => 'form-process-'.$uri]) }}
          <div class="alert alert-danger fade show" role="alert" hidden>
            <h5><i class="fa fa-info-circle"></i> ERROR</h5>
            <div id="alert"></div>
          </div>

          <div class="form-group row m-b-10">
            <label class="col-form-label col-md-3">Jenis</label>
            <div class="col-md-9">
              <span class="form-control no-border">
                @if($extension == 'Inap')
                  {{ $trans->jenis }} <i class="fas fa-arrow-alt-circle-right text-primary"></i> {{ $extension }}
                @else
                  {{ $trans->jenis }}
                @endif
              </span>
            </div>
          </div>

          <div class="form-group row m-b-15">
            <label class="col-form-label col-md-3">Durasi</label>
            <div class="col-md-9">
              <span class="form-control no-border">{{ $durasi }}</span>
            </div>
          </div>

          @if (!empty($trans->bayar))
            <div class="form-group row m-b-15">
              <label class="col-form-label col-md-3">Bayar Dimuka</label>
              <div class="col-md-9">
                <span class="form-control no-border">Rp.{{ number_format($trans->bayar,0,',','.') }}</span>
              </div>
            </div>
          @endif

          <div class="invoice-price m-b-15">
            <div class="invoice-price-right">
              <small>TARIF</small><span id="total_vendor_cost">Rp. {{ number_format($total_biaya,0,',','.') }}</span>
            </div>
          </div>

          @if(!empty($trans->bayar) && $total_biaya-$trans->bayar != '0')
            <div class="invoice-price m-b-15">
              <div class="invoice-price-right bg-warning">
                <small>SISA PEMBAYARAN</small><span id="total_vendor_cost">Rp. {{ number_format($total_biaya-$trans->bayar,0,',','.') }}</span>
              </div>
            </div>
          @elseif($total_biaya-$trans->bayar == '0')
            <div class="invoice-price m-b-15">
              <div class="invoice-price-right bg-success">
                <small>PEMBAYARAN</small><span id="total_vendor_cost"><strong>L U N A S</strong></span>
              </div>
            </div>
          @endif
    </div>
    <div class="modal-footer">
      <button class="btn btn-success" onclick="process_trans()">Proses</button>
    </div>
</div>
<script>
  $(function () {
    $("[data-toggle='tooltip']").tooltip();
  });
</script>
