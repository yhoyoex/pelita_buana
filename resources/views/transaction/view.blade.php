<div class="tab-pane fade" id="trans{{ $trans->id }}">
  <div class="panel-toolbar bg-black-transparent-1 m-b-20" style="margin: -15px -15px 20px -15px;">
    <div class="row text-center">
      <div class="col-md-6">
        <div class="float-md-left">
        </div>
      </div>
      <div class="col-md-6">
        <div class="float-md-right">
          @ability('root','proses-transaksi')
          @if($trans->status == '0')
          <a href="javascript:;" id="btn_edit" class="btn btn-success m-b-5" onclick="process_data('{{$uri}}')"><i class="fas fa-check"></i> Proses Keluar</a>
          @endif
          @endability
          @ability('root','print-struk')
          @if($trans->status == '1')
          <a href="javascript:;" class="btn btn-primary m-b-5" onclick="print()"><i class="fas fa-print"></i> Print Struk</a>
          @endif
          @endability
          @ability('root','cancel-transaksi')
          <a href="javascript:;" class="btn btn-warning m-b-5" onclick="cancel_data('{{$uri}}')"><i class="fas fa-trash"></i> Batal</a>
          @endability
          @ability('root','destroy-transaksi')
          <a href="javascript:;" class="btn btn-danger m-b-5" onclick="destroy_data('{{$uri}}')"><i class="fas fa-trash"></i> Hapus</a>
          @endability
        </div>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table width="100%" class="table table-bordered">
      <tbody>
        <tr>
          <td width="25%">
            <div class="m-t-5 m-b-5"><span class="p-r-15">No. Trans : </span><span><strong>{{ $trans->no_trans }}</strong></span></div>
          </td>
          <td width="25%">
            <div class="m-t-5 m-b-5"><span class="p-r-15">No. Tiket : </span><span><strong>{{ $trans->no_tiket }}</strong></span></div>
          </td>
          <td width="25%">
            <div class="m-t-5 m-b-5"><span class="p-r-15">Jenis : </span><span><strong>
              @if($extension == 'Inap')
                {{ $trans->jenis }} <i class="fas fa-arrow-alt-circle-right text-primary"></i> {{ $extension }}
              @else
                {{ $trans->jenis }}
              @endif
            </strong></span></div>
          </td>
          <td width="25%">
            <div class="m-t-5 m-b-5"><span class="p-r-15">Status : </span>
              @if ($trans->status == '0') <span class='label label-primary'>Kendaraan masih di dalam</span>
              @elseif ($trans->status == '1') <span class='label label-success'>Kendaraan sudah keluar</span>
              @elseif ($trans->status == '2') <span class='label label-danger'>Transaksi dibatalkan</span>
              @endif
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <table width="100%" class="table table-bordered">
      <tbody>
        <tr>
          <td width="25%">
            <div class="m-t-5 m-b-5"><span class="p-r-15">Waktu Masuk :</span> <span><strong>{{ date('d M Y H:i', strtotime($trans->tgl_masuk))}}</strong></span></div>
          </td>
          <td width="25%">
            <div class="m-t-5 m-b-5"><span class="p-r-15">Waktu Keluar :</span> <span><strong>{{ $trans->tgl_keluar ? date('d M Y H:i', strtotime($trans->tgl_keluar)) : '-' }}</strong></span></div>
          </td>
          <td width="25%">
            <div class="m-t-5 m-b-5"><span class="p-r-15">Durasi : </span><span><strong>{{ $durasi }}</strong></span></div>
          </td>
        </tr>
      </tbody>
    </table>

    <table width="100%" class="table table-bordered">
      <tbody>
        <tr>
          <td width="25%">
            <div class="m-t-5 m-b-5"><span class="p-r-15">Kasir Masuk : </span><span><strong>{{ $trans->ksr_masuk->name }}</strong></span></div>
          </td>
          <td width="25%">
            <div class="m-t-5 m-b-5"><span class="p-r-15">Kasir Keluar : </span><span><strong>{{ $trans->ksr_keluar ? $trans->ksr_keluar->name : '-'}}</strong></span></div>
          </td>
          <td width="25%">
            <div class="m-t-5 m-b-5"><span class="p-r-15">Driver : </span><span><strong>{{ $trans->drivers ? $trans->drivers->nama : '-' }}</strong></span></div>
          </td>
        </tr>
      </tbody>
    </table>

    <table width="100%" class="table table-bordered">
      <tbody>
        <tr>
          <td width="50%">
            <span><strong>Pelanggan</strong></span>
            <hr />
            <div class="row m-b-10">
              <span class="col-md-2">Nama</span>
              <div class="col-md-9">
                <span><strong>: {{ $trans->pelanggan ? $trans->pelanggan->nama : '-' }}</strong></span>
              </div>
            </div>
            <div class="row m-b-10">
              <span class="col-md-2">Tlp.</span>
              <div class="col-md-9">
                <span><strong>: {{ $trans->pelanggan ? $trans->pelanggan->tlp : '-' }}</strong></span>
              </div>
            </div>
          </td>
          <td width="50%">
            <span><strong>Kendaraan</strong></span>
            <hr />
            <div class="row m-b-10">
              <span class="col-md-2">Nopol</span>
              <div class="col-md-9">
                <span><strong>: {{ $trans->kendaraan->nopol }}</strong></span>
              </div>
            </div>
            <div class="row m-b-10">
              <span class="col-md-2">Merk/Type</span>
              <div class="col-md-9">
                <span><strong>: {{ $trans->kendaraan->merk_type }}</strong></span>
              </div>
            </div>
            <div class="row m-b-10">
              <span class="col-md-2">Warna</span>
              <div class="col-md-9">
                <span><strong>: {{ $trans->kendaraan->warna }}</strong></span>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <table width="100%" class="table table-bordered">
      <tbody>
        <tr>
          <td width="25%">
            <span><strong>Catatan : </strong></span>
            <hr />
            {{ $trans->kendaraan->catatan }}
          </td>
          <td width="25%">
            <span><strong>Kondisi Fisik Kendaraan : </strong></span>
            <hr />
            {{ $trans->kendaraan->kondisi_fisik }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="invoice-content m-b-20">
      <div class="invoice-price">
          <div class="invoice-price-left" style="background:white">
            @if(!empty($trans->bayar))
            <div class="invoice-price-left">
                <div class="invoice-price-row">
                    <div class="sub-price">
                        <small>BAYAR DIMUKA</small>
                        Rp.{{ number_format($trans->bayar,0,',','.') }}
                    </div>
                </div>
            </div>
            @endif
          </div>
          <div class="invoice-price-right">
              <small>TARIF</small> Rp. {{ $total_biaya }}
          </div>
      </div>
  </div>
  <div class="invoice-footer text-muted">
  </div>
</div>
<script>

function process_trans(){
  var id = '{{ $trans->id }}';
  var extension = '{{ $extension }}';
  var transaction_number = '{{ $trans->no_tiket }}';
	var element_trans = document.getElementById("#trans"+id);
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  form_data = $('#form-process-{{ $uri }}').serializeArray();
  form_data.push({name:'extension', value:extension});
  $.ajax({
    type:"PATCH",
    url:'{{ url("$uri") }}'+'/process/'+ id,
    data:form_data,
    success: function(data){
      $.ajax({
		    type:"GET",
        url:'{{ $uri }}'+'/view/'+ id,
		    success: function(res) {
	        $('.tab-content [id=trans'+id+']').replaceWith(res);
          $('.tab-content [id=trans'+id+']').addClass('active show');
          $('#modal_{{ $uri }}').modal('hide');
          $.gritter.add({title:"Data diproses!",text:"Anda memproses data {{ $uri }}."}),
          reload_data();
          print();
		    }
		  });
    },
       error: function(data){
        console.log(data);
        swal('Error','Someting Wrong','error');
    }
  })
}

function print() {
  var id = '{{ $trans->id }}';
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
    type:"GET",
    url:'{{ $uri }}'+'/print/'+ id,
    success: function(res) {
      console.log(res);
      if( {!! json_encode(Settings::get_settings('koneksi_printer')) !!} === 'Recta' ) {
        // console.log(res);
        var printer = new Recta( {!! json_encode(Settings::get_settings('app_key_recta')) !!}, {!! json_encode(Settings::get_settings('port_recta')) !!});
        printer.open().then(function () {
          printer.mode('A',true,true,true,false)
          printer.align('left')
          printer.text('   Premierre')
          printer.align('Right')
          printer.text('Valet Service   ')
          printer.mode('B',false,false,false,false)
          printer.text('Bandar Udara International Sultan Hasanuddin Makassar')
          printer.text('------------------------------------------------------')
          printer.align('left')
          printer.raw('  No. Transaksi: ')
          printer.text(res.no_trans)
          printer.raw('  No. Tiket    : ')
          printer.text(res.no_tiket)
          printer.feed(1)
          printer.raw('  No. Polisi   : ')
          printer.text(res.nopol)
          printer.raw('  Valet Type   : ')
          printer.text(res.valet_type)
          printer.raw('  Valet In     : ')
          printer.text(res.valet_in)
          printer.raw('  Valet Out    : ')
          printer.text(res.valet_out)
          if (res.valet_type === "Inap" || res.extend === "Inap") {
            printer.raw('  Durasi     : ')
            printer.text(res.durasi)
          }
          printer.feed(1)
          printer.raw('  Tarif        : ')
          printer.mode('A',true,false,true,false)
          printer.text(res.tarif)
          printer.mode('B',false,false,false,false)
          printer.raw('                 ')
          printer.text('("Tarif belum termasuk tarif parkir")')
          printer.feed(2)
          printer.align('center')
          printer.text('Terimakasih Telah Menggunakan Jasa Kami')
          if (res.contact !== null && res.contact !== '') {
            printer.raw('Contact : ')
            printer.text(res.contact)
          }
          printer.feed(5)
          printer.cut(false, 0)
          printer.print()
          printer.close()
        })
        swal({type: 'success',title: 'Printing...',showConfirmButton: false,timer: 3000});
      } else if ( {!! json_encode(Settings::get_settings('koneksi_printer')) !!} === 'CUPS' ) {
        swal({type: 'success',title: 'Printing...',showConfirmButton: false,timer: 3000});
      } else {
        swal('Error','Terjadi kesalahan, harap laporkan masalah','error');
      }
    },
    error: function(res) {
      swal({type: 'warning',title: 'Print tidak ditemukan',showConfirmButton: true});
    }
  });
}
</script>
