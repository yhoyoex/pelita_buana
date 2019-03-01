
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- begin row -->
<div class="row">
	<!-- begin col-3 -->
  @ability('root','dashboard-kendaraan-didalam')
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-gradient-blue">
			<div class="stats-icon"><i class="far fa-car"></i></div>
			<div class="stats-info">
				<h4>KENDARAAN DIDALAM</h4>
				<br>
				<p>{{ $total_in }}</p>
			</div>
			<div class="stats-link">
				{{-- <a href="javascript:;" data-toggle="ajax">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a> --}}
				<br>
			</div>
		</div>
	</div>
  @endability
	<!-- end col-3 -->
	<!-- begin col-3 -->
  @ability('root','dashboard-kendaraan-masuk')
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-gradient-aqua">
			<div class="stats-icon"><i class="far fa-arrow-alt-circle-down"></i></div>
			<div class="stats-info">
				<h4>KENDARAAN MASUK HARI INI</h4>
				<br>
				<p>{{$in_day}}</p>
			</div>
			<div class="stats-link">
				{{-- <a href="javascript:;" data-toggle="ajax">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a> --}}
				<br>
			</div>
		</div>
	</div>
  @endability
	<!-- end col-3 -->
	<!-- begin col-3 -->
  @ability('root','dashboard-kendaraan-keluar')
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-gradient-purple">
			<div class="stats-icon"><i class="far fa-arrow-alt-circle-up"></i></div>
			<div class="stats-info">
				<h4>KENDARAAN KELUAR HARI INI</h4>
				<br>
				<p>{{ $out_day }}</p>
			</div>
			<div class="stats-link">
				{{-- <a href="javascript:;" data-toggle="ajax">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a> --}}
				<br>
			</div>
		</div>
	</div>
  @endability
	<!-- end col-3 -->
	<!-- begin col-3 -->
	@ability('root','dashboard-transaksi')
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-gradient-green">
			<div class="stats-icon"><i class="far fa-money-bill-alt"></i></div>
			<div class="stats-info">
				<h4>TRANSAKSI HARI INI</h4>
				<br>
				<p>Rp. {{ number_format($income_day,0,',','.') }}</p>
			</div>
			<div class="stats-link">
				{{-- <a href="javascript:;" data-toggle="ajax">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a> --}}
				<br>
			</div>
		</div>
	</div>
	@endability
	<!-- end col-3 -->
  <!-- begin col-3 -->
	@ability('root','dashboard-transaksi-petugas')
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-gradient-green">
			<div class="stats-icon"><i class="far fa-money-bill-alt"></i></div>
			<div class="stats-info">
				<h4>TRANSAKSI ANDA HARI INI</h4>
				<br>
				<p>Rp. {{ number_format($k_income_day,0,',','.') }}</p>
			</div>
			<div class="stats-link">
				{{-- <a href="javascript:;" data-toggle="ajax">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a> --}}
				<br>
			</div>
		</div>
	</div>
	@endability
	<!-- end col-3 -->
</div>
@ability('root','dashboard-grafik-bulanan')
<div class="panel panel-inverse panel-hover-icon">
	<div class="panel-heading">
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			{{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> --}}
			{{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> --}}
			{{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> --}}
		</div>
		<h4 class="panel-title">Grafik Bulanan</h4>
	</div>
	<div class="panel-body">
    <div id="chartLegend" class="m-b-10 d-flex justify-content-center"></div>
		<div id="interactive-chart" class="height-md"></div>
	</div>
</div>
@endability
<!-- end row -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script>
  App.setPageTitle('{{ Settings::get_settings('app_name') }} | {{ $title }}' );
  App.restartGlobalFunction();
  $.getScript('{{ asset("plugins/chart-js/Chart.min.js") }}'),
  $.when(
    $.getScript('{{ asset("plugins/flot/jquery.flot.min.js") }}'),
    $.getScript('{{ asset("plugins/flot/jquery.flot.time.min.js") }}'),
    $.getScript('{{ asset("plugins/flot/jquery.flot.resize.min.js") }}'),
    $.getScript('{{ asset("plugins/flot/jquery.flot.pie.min.js") }}'),
    $.getScript('{{ asset("plugins/flot/jquery.flot.axislabels.js") }}'),
    $.getScript('{{ asset("plugins/sparkline/jquery.sparkline.js") }}'),
    $.getScript('{{ asset("plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") }}'),
    $.Deferred(function( deferred ){
    	$(deferred.resolve);
    })
	).done(function() {
    if(0!==$("#interactive-chart").length){
      in_total = {{ $in_total }};
      out_total = {{ $out_total }};
      income_total = {{ $income_total }};

			t=[[1,"Jan"],[2,"Feb"],[3,"Mar"],[4,"Apr"],[5,"May"],[6,"Jun"],[7,"Jul"],[8,"Aug"],[9,"Sep"],[10,"Okt"],[11,"Nov"],[12,"Des"]];
			$.plot($("#interactive-chart"),[
        {data:in_total,color:"#0062FF",label:"Total Kendaraan Masuk",lines:{show:!0,fill:!1,lineWidth:2},points:{show:!0,radius:3},yaxis: 1,shadowSize:0},
				{data:out_total,color: "#008000",label:"Total Kendaraan Keluar",lines:{show:!0,fill:!1,lineWidth:2},points:{show:!0,radius:3},yaxis: 1,shadowSize:0},
        {data:income_total,color: "#FF0000",label:"Total Pendapatan",lines:{show:!0,fill:!1,lineWidth:2},points:{show:!0,radius:3},yaxis: 2,shadowSize:0}
      ],
			{
        xaxis:{
          ticks:t,
          axisLabel:"Bulan",
          tickDecimals:0,
        },
			  yaxes: [
          {
            position: "right",
            axisLabel: "Jumlah Kendaraan",
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            axisLabelPadding: 5
          },
          {
            position: "left",
            axisLabel: "Pendapatan (Rp.)",
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            axisLabelPadding: 5
          }
        ],
        grid:{hoverable:!0,clickable:!0,borderWidth:1,backgroundColor:'transparent'},
        legend:{margin:10,noColumns:3,container: $("#chartLegend")}
			});

      var l=null;
			$("#interactive-chart").bind("plothover",function(event, pos, item){
        if (item) {
          previousPoint = null;
          if (previousPoint != item.dataIndex) {
            previousPoint = item.dataIndex;
            $("#tooltip").remove();
            var x = item.datapoint[0];
            var y = item.datapoint[1];
            var z = t[x-1];
            showTooltip(item.pageX, item.pageY,
            "Bulan :" +z[1] + "<br/>" + item.series.label + "<br/> <strong>" + y + "</strong>");
          }
        }
        else {
            $("#tooltip").remove();
            previousPoint = null;
        }
			});

      function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css({
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 20,
            border: '2px solid #4572A7',
            padding: '2px',
            size: '10',
            'border-radius': '6px 6px 6px 6px',
            'background-color': '#fff',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
      }
		}
	});
</script>
<!-- ================== END PAGE LEVEL JS ================== -->
