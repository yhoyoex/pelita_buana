<div class="tab-pane fade" id="trans0">
{{ Form::open(['url' => '#', 'class' => 'form-control-with-bg', 'id' => 'form-buat-transaksi','style'=> 'margin: -15px -15px -15px -15px','data-parsley-validate'=>'', 'autocomplete' => 'off']) }}
  <div class="panel-body m-t-20">
    <div class="alert alert-danger fade show" role="alert" hidden>
      <h5><i class="fa fa-info-circle"></i> ERROR</h5>
      <div id="alert"></div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <fieldset class="fsStyle">
          <legend class="legendStyle text-primary">TRANSAKSI</legend>
          <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">No. Tiket <span class="text-danger">*</span></label>
            <div class="col-md-8">
              {{ Form::number('no_tiket', null, ['placeholder' => 'Nomor Tiket','class' => 'form-control', 'id' => 'no_tiket', 'data-parsley-required'=>"true", 'autocomplete' => 'new-password', 'data-parsley-type'=>'number']) }}
            </div>
          </div>
          <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Jenis <span class="text-danger">*</span></label>
            <div id="jenis" class="col-md-8">
              <div class="radio radio-css radio-inline">
                <input type="radio" id="reguler" name="jenis" value="Reguler" data-parsley-required="true" data-parsley-errors-container='#jenis_error'/>
                <label for="reguler">REGULER</label>
              </div>
              <div class="radio radio-css radio-inline">
                <input type="radio" id="inap" name="jenis" value="Inap"/>
                <label for="inap">INAP</label>
              </div>
              <div id="jenis_error"></div>
            </div>
          </div>
          <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Bayar <span class="text-primary"><i class="fas fa-question-circle fa-lg" data-toggle="tooltip" data-placement="top" title="Isi jika customer membayar biaya pada saat masuk"></i></span></label>
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-1">
                  <div class="checkbox checkbox-css">
                    <input type="checkbox" id="check-bayar"/>
                    <label for="check-bayar"></label>
                  </div>
                </div>
                <div class="col-md-11">
                  <div id="input-bayar" style="display:none">
                    {{ Form::text('bayar', null, ['placeholder' => 'Jumlah Pembayaran','class' => 'form-control m-t-10', 'id' => 'bayar', 'readonly']) }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="fsStyle">
          <legend class="legendStyle text-primary">PELANGGAN</legend>
          <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Nama <span class="text-danger form_required">*</span></label>
            <div class="col-md-8">
              {{ Form::text('nama_pelanggan', null, ['placeholder' => 'Nama Pelanggan','class' => 'form-control', 'id' => 'nama_pelanggan', 'data-parsley-required'=>"true"]) }}
            </div>
          </div>
          <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Tlp. <span class="text-danger form_required">*</span></label>
            <div class="col-md-8">
              {{ Form::number('tlp_pelanngan', null, ['placeholder' => 'Telp. Pelanggan','class' => 'form-control', 'id' => 'tlp_pelanngan', 'data-parsley-required'=>"true"]) }}
            </div>
          </div>
        </fieldset>
        <fieldset class="fsStyle">
          <legend class="legendStyle text-primary">PETUGAS</legend>
          <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Penerima <span class="text-danger">&nbsp;</span></label>
            <div class="col-md-8">
              {{ Form::text('kasir_masuk',  Auth::user()->name, ['class' => 'form-control', 'id' => 'kasir_masuk', 'readonly']) }}
            </div>
          </div>
          <div class="form-group row m-b-10" id="driver_field">
            <label class="col-md-3 col-form-label text-md-right">Driver <span class="text-danger">*</span></label>
            <div class="col-md-8">
              {{ Form::select('driver', $driver, [], ['title' => '-- Pilih Driver --','class' => 'form-control selectpicker dropup', 'size' => '5', 'data-live-search' => 'true', 'data-style' => 'btn-white','data-toggle'=>'ajax', 'id' => 'driver', 'data-parsley-required'=>'true','data-parsley-errors-container'=>'#driver_error']) }}
              <div id="driver_error"></div>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="col-md-6">
        <fieldset class="fsStyle">
          <legend class="legendStyle text-primary">KENDARAAN</legend>
          <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Nopol <span class="text-danger">*</span></label>
            <div class="col-md-8">
              {{ Form::text('nopol', null, ['placeholder' => 'Nomor Polisi Kendaraan','class' => 'form-control', 'id' => 'nopol', 'data-parsley-required'=>"true", 'autocomplete' => 'new-password']) }}
            </div>
          </div>
          <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Merk/Type <span class="text-danger">*</span></label>
            <div class="col-md-8">
              {{ Form::text('merk_type', null, ['placeholder' => 'Merk/Type Kendaraan','class' => 'form-control', 'id' => 'merk_type', 'data-parsley-required'=>"true", 'style' => 'text-transform:capitalize;']) }}
            </div>
          </div>
          <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Warna <span class="text-danger">*</span></label>
            <div class="col-md-8">
              {{ Form::text('color', null, ['placeholder' => 'Warna Kendaraan','class' => 'form-control', 'id' => 'color', 'data-parsley-required'=>"true", 'style' => 'text-transform:capitalize;']) }}
            </div>
          </div>
          <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Kondisi <span class="text-danger">*</span></label>
            <div class="col-md-8">
              {{ Form::textarea('kondisi_kendaraan', null, ['placeholder' => 'Kondisi fisik Kendaraan','class' => 'form-control', 'size' => '20x5', 'id' => 'kondisi_kendaraan', 'data-parsley-required'=>"true", 'style' => 'text-transform:capitalize;']) }}
            </div>
          </div>
          <div class="form-group row m-b-10">
            <label class="col-md-3 col-form-label text-md-right">Catatan <span class="text-danger">&nbsp;</span></label>
            <div class="col-md-8">
              {{ Form::textarea('catatan_kendaraan', null, ['placeholder' => 'Catatan','class' => 'form-control', 'size' => '20x3', 'id' => 'catatan_kendaraan', 'style' => 'text-transform:capitalize;']) }}
            </div>
          </div>
        </fieldset>
        <div class="invoice-price m-b-15">
          <div class="invoice-price-right">
            <small>Tarif</small><strong><span id="biaya">Rp. 0</span></strong>
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row text-center m-15">
    <div class="col-md-12">
      <div class="float-md-right">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
{{ Form::close() }}
</div>

<script>
  $.getScript('{{ asset("plugins/parsley/dist/parsley.js") }}').done(function() {
  $.when(
    $.getScript('{{ asset("plugins/price_format/jquery.price_format.2.0.js") }}'),
    $.getScript('{{ asset("plugins/bootstrap-select/bootstrap-select.min.js") }}'),
    $.Deferred(function( deferred ){
      $(deferred.resolve);
    })
    ).done(function() {
      // $('#bayar').priceFormat({
      //   prefix: '',
      //   thousandsSeparator:'.',
      //   centsLimit: 0
      // });
      $('#nopol').keyup(function() {
		    $(this).val($(this).val().toUpperCase().replace(/^\s+|\s+$/g, ''));
	    });
      $('#no_tiket').keyup(function() {
		    $(this).val($(this).val().toUpperCase().replace(/^\s+|\s+$/g, ''));
	    });
      $('#nama_pelanggan').keyup(function() {
		    $(this).val($(this).val().toUpperCase());
	    });
    //   $('input').on('keydown', function(event) {
    //     if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
    //        var $t = $(this);
    //        event.preventDefault();
    //        var char = String.fromCharCode(event.keyCode);
    //        $t.val(char + $t.val().slice(this.selectionEnd));
    //        this.setSelectionRange(1,1);
    //     }
    // });
      var color = ["Hitam","Putih","Merah","Coklat","Silver","Hijau","Abu-abu","Kuning"];
      var car_type = [
        "Toyota Avanza",
        "Toyota Rush",
        "Toyota Fortuner",
        "Toyota Alphard",
        "Toyota Agya",
        "Toyota Camry",
        "Toyota Kijang",
        "Toyota Altis",
        "Toyota Voxy",
        "Toyota Vios",
        "Toyota Yaris",
        "Toyota Velfire",
        "Toyota Prius",
        "Toyota Etios",
        "Toyota Crown",
        "Toyota Cruiser",
        "Ford Ecosport",
        "Ford Everest",
        "Ford Fiesta",
        "Ford Focus",
        "Ford Ranger",
        "Honda Jazz",
        "Honda City",
        "Suzuki Vitara",
        "Suzuki Karimun",
        "Suzuki APV",
        "Suzuki Carry",
        "Suzuki Celerio",
        "Suzuki Ertiga",
        "Suzuki Baleno",
        "Suzuki Spalsh",
        "Suzuki Swift",
        "Suzuki SX4",
        "Daihatsu Xenia",
        "Daihatsu Grandmax",
        "Daihatsu Terios",
        "Daihatsu Ayla",
        "Daihatsu Luxio",
        "Daihatsu Sirion",
        "Datsun GO+",
        "Hyundai Excel",
        "Hyundai Avega",
        "Hyundai Santa",
        "Hyundai Sonata",
        "Hyundai Tucson",
        "Hyundai Starex",
        "Mitsubishi Xpander",
        "Mitsubishi Pajero",
        "Mitsubishi Outlander",
        "Mitsubishi Delica",
        "Mitsubishi Mirage",
        "Mitsubishi Strada",
        "Mitsubishi L-300",
        "Nissan Juke",
        "Nissan X-Trail",
        "Nissan March",
        "Nissan Livina",
        "Nissan Evalia",
        "Nissan Murano",
        "Nissan Serena",
        "Nissan Teana",
        "Honda HR-V",
        "Honda CR-V",
        "Honda Mobilio",
        "Honda Accord",
        "Honda Brio",
        "Honda CR-Z",
        "Honda Odyssey",
        "BMW",
        "Peugeot",
        "Proton",
        "Mercedes Benz",
        "Chevrolet Cruze",

      ];
      $( "#color" ).autocomplete({source: color});
      $( "#merk_type" ).autocomplete({source: car_type});
      $(".selectpicker").selectpicker("render");
      $('input[type=radio][name=jenis]').change(function() {
        jenis = this.value;
        $.ajax({
          type:"GET",
          url:'transaction/get-harga/' + jenis,
          success: function(data){
            biaya = data;
            if (jenis == 'Reguler') {
              $('#biaya').html(data);
              $('#driver_field').css({'display':'none'});
              $('#driver').attr('data-parsley-required','false');
              $('#nama_pelanggan').attr('data-parsley-required','false');
              $('#tlp_pelanngan').attr('data-parsley-required','false');
              $('#driver').val('');
              $('.form_required').html('');
              if($("#check-bayar").prop( "checked" )) {
                $('#bayar').val(biaya.replace('Rp.',''));
              }
            } else {
              $('#biaya').html(data+' / Hari');
              $('#driver_field').css({'display':''});
              $('#driver').attr('data-parsley-required','true');
              $('#nama_pelanggan').attr('data-parsley-required','true');
              $('#tlp_pelanngan').attr('data-parsley-required','true');
              $('.form_required').html('*');
              if($("#check-bayar").prop( "checked" )) {
                $('#bayar').val(biaya.replace('Rp.',''));
              }
            }
          },
          error: function(data){
            swal('Error','Terjadi kesalahan system, harap laporkan masalah','error');
          }
        });
      });
      $("#check-bayar").change(function() {
        if(this.checked) {
          $('#input-bayar').css({'display':'block'});
          // $('#bayar').attr('data-parsley-required','true');
          if(jenis == 'Reguler') {
              $('#bayar').val(biaya.replace('Rp.',''));
          } else if(jenis == 'Inap') {
            $('#bayar').val(biaya.replace('Rp.',''));
          } else {
            $('#bayar').val('0');
          }
        } else {
          $('#input-bayar').css({'display':'none'});
          // $('#bayar').attr('data-parsley-required','false');
          $('#bayar').val('0');
        }
      });

      $('#form-buat-transaksi').on('submit', function (e) {
        e.preventDefault();
        $('#form-buat-transaksi').parsley('validate');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        if($('#form-buat-transaksi').parsley().isValid()) {
          $.ajax({
            type:"POST",
            url:'transaction/store',
            data:$('#form-buat-transaksi').serialize(),
            success: function(data){
              $.gritter.add({title:"Transaksi dibuat!",text:"Transaksi baru dibuat."});
              close_tab(0);
              reload_data();
            },
            error: function(data){
              if(data.status == 422) {
                $('.alert').removeAttr('hidden');
                for (var error in data.responseJSON.errors) {$('#alert').append(data.responseJSON.errors[error]+'<br>')};
              } else {
                error = data.responseJSON.message;
                swal('Error',error,'error');
                console.log(data);
              }
            }
          })
        } else {
          swal('Error','Periksa data isian','error');
        }
      });

    });
  });
  $(function () {
    $("[data-toggle='tooltip']").tooltip();
  });
</script>
