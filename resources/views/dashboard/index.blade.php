@extends('layouts.main')

@section('container')

<!-- row -->
<div class="row row-sm">
	@foreach($totals as $total)
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card {{$total['class']}}">
			<div class="px-3 pt-3 pb-2">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">{{ $total['title'] }}</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 fw-bold mb-1 text-white">{{ $total['total'] }}</h4>
							<p class="mb-0 tx-12 text-white op-7">Dibandingkan bulan lalu</p>
						</div>
						<span class="float-end my-auto ms-auto">
							<i class="fas fa-arrow-circle-up text-white"></i>
							<span class="text-white op-7"> +{{ $total['difference'] }}</span>
						</span>
					</div>
				</div>
			</div>
			<span id="{{ $total['chart_id'] }}" class="pt-1">{{ implode(',', $total['chart_data']) }}</span>
		</div>
	</div>
	@endforeach

	<div class="col-12">
		<div class="card mg-b-20">
			<div class="card-body">
				<div class="main-content-label mg-b-5">
					Jumlah Perjalanan Dinas
				</div>
				<p class="mg-b-20">Jumlah Perjalanan dinas masing-masing bidang.</p>
				<div class="morris-wrapper-demo" id="morrisBar2"></div>
			</div>
		</div>
	</div>
</div>

<div class="row row-sm">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mb-0">Jumlah & Maksimal Perjalanan Dinas Pegawai</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
			</div>
			<div class="card-body b-p-apex">
				<div class="total-revenue">
					<div>
						<h4>{{ $ketentuans->sum('jumlah_perdin') }}</h4>
						<label><span class="bg-primary"></span>Jumlah Perdin</label>
					</div>
					<div>
						<h4>{{ $ketentuans->sum('max_perdin') }}</h4>
						<label><span class="bg-danger"></span>Maksimal Perdin</label>
					</div>
				</div>
				<div id="bar" class="sales-bar mt-4"></div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="card card-table-two">
			<div class="d-flex justify-content-between">
				<h4 class="card-title mb-1">Data Pegawai Perjalanan Dinas</h4>
				<i class="mdi mdi-dots-horizontal text-gray"></i>
			</div>
			<div class="table-responsive country-table">
				<table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
					<thead>
						<tr>
							<th class="wd-lg-25p" style="width: 1%">No</th>
							<th class="wd-lg-25p tx-right">Nama</th>
							<th class="wd-lg-25p tx-right">Jumlah Perdin</th>
							<th class="wd-lg-25p tx-right">Maksimal Perdin</th>
							<th class="wd-lg-25p tx-right">Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($ketentuans as $ketentuan)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $ketentuan->pegawai->nama }}</td>
							<td class="tx-right tx-medium tx-inverse">{{ $ketentuan->jumlah_perdin }}</td>
							<td class="tx-right tx-medium tx-inverse">{{ $ketentuan->jumlah_perdin }}</td>
							<td>{{ $ketentuan->tersedia ? 'Tersedia' : 'Sedang Perjalanan Dinas' }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')
<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

<!-- JQuery min js -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Bundle js -->
<script src="/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!--Internal  Morris js -->
<script src="/assets/plugins/raphael/raphael.min.js"></script>
<script src="/assets/plugins/morris.js/morris.min.js"></script>

<!-- Apexchart js-->
<script src="/assets/js/apexcharts.js"></script>

<script>
	$(function () {
		$('#compositeline').sparkline('html', {
			lineColor: 'rgba(255, 255, 255, 0.6)',
			lineWidth: 2,
			spotColor: false,
			minSpotColor: false,
			maxSpotColor: false,
			highlightSpotColor: null,
			highlightLineColor: null,
			fillColor: 'rgba(255, 255, 255, 0.2)',
			chartRangeMin: 0,
			chartRangeMax: 20,
			width: '100%',
			height: 30,
			disableTooltips: true
		});
		$('#compositeline2').sparkline('html', {
			lineColor: 'rgba(255, 255, 255, 0.6)',
			lineWidth: 2,
			spotColor: false,
			minSpotColor: false,
			maxSpotColor: false,
			highlightSpotColor: null,
			highlightLineColor: null,
			fillColor: 'rgba(255, 255, 255, 0.2)',
			chartRangeMin: 0,
			chartRangeMax: 20,
			width: '100%',
			height: 30,
			disableTooltips: true
		});
		$('#compositeline3').sparkline('html', {
			lineColor: 'rgba(255, 255, 255, 0.6)',
			lineWidth: 2,
			spotColor: false,
			minSpotColor: false,
			maxSpotColor: false,
			highlightSpotColor: null,
			highlightLineColor: null,
			fillColor: 'rgba(255, 255, 255, 0.2)',
			chartRangeMin: 0,
			chartRangeMax: 30,
			width: '100%',
			height: 30,
			disableTooltips: true
		});
		$('#compositeline4').sparkline('html', {
			lineColor: 'rgba(255, 255, 255, 0.6)',
			lineWidth: 2,
			spotColor: false,
			minSpotColor: false,
			maxSpotColor: false,
			highlightSpotColor: null,
			highlightLineColor: null,
			fillColor: 'rgba(255, 255, 255, 0.2)',
			chartRangeMin: 0,
			chartRangeMax: 20,
			width: '100%',
			height: 30,
			disableTooltips: true
		});
	});
</script>

<script>
	$(function() {
		'use strict';

		new Morris.Bar({
			element: 'morrisBar2',
			data: {!! $morrisData !!},
			xkey: 'bidang',
			ykeys: ['perdin'],
			labels: ['Jumlah Perdin'],
			barColors: ['#6D6EF3'],
			gridTextSize: 11,
			hideHover: 'auto',
			resize: true,
			redraw: true,
			xLabelAngle: 50,
		});
	});
</script>

<script>
	function indexbar() {
		var optionsBar = {
			chart: {
				height: 249,
				responsive: 'true',
				type: 'bar',
				toolbar: {
					show: false,
				},
				fontFamily: 'Nunito, sans-serif',
			},
			colors: [myVarVal, '#f93a5a', '#f7a556'],
			plotOptions: {
				bar: {
					dataLabels: {
						enabled: false
					},
					columnWidth: '42%',
					endingShape: 'rounded',
				}
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				show: true,
				width: 2,
				endingShape: 'rounded',
				colors: ['transparent'],
			},
			responsive: [{
				enable: 'true',
				breakpoint: 576,
				options: {
					stroke: {
						show: true,
						width: 1,
						endingShape: 'rounded',
						colors: ['transparent'],
					},
				},

			}],
			series: [{
				name: 'Jumlah Perdin',
				data: {{ Js::from($ketentuans->pluck('jumlah_perdin')) }},
			}, {
				name: 'Max Perdin',
				data: {{ Js::from($ketentuans->pluck('max_perdin')) }},
			}],
			xaxis: {
				categories: {{ Js::from($nama_pegawai) }},
			},
			fill: {
				opacity: 1
			},
			legend: {
				show: false,
				floating: true,
				position: 'top',
				horizontalAlign: 'left',


			},

			tooltip: {
				y: {
					formatter: function (val) {
						return val;
					}
				}
			}
		}
		document.querySelector('#bar').innerHTML = ""
		new ApexCharts(document.querySelector('#bar'), optionsBar).render();
	}
</script>

<!--Internal  Chart.bundle js -->
<script src="/assets/plugins/chart.js/Chart.bundle.min.js"></script>

<!-- Moment js -->
<script src="/assets/plugins/moment/moment.js"></script>

<!--Internal Sparkline js -->
<script src="/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/plugins/perfect-scrollbar/p-scroll.js"></script>

<!-- Eva-icons js -->
<script src="/assets/js/eva-icons.min.js"></script>

<!-- Sticky js -->
<script src="/assets/js/sticky.js"></script>
<script src="/assets/js/modal-popup.js"></script>

<!-- Left-menu js-->
<script src="/assets/plugins/side-menu/sidemenu.js"></script>

<!--Internal  index js -->
{{-- <script src="/assets/js/index.js"></script> --}}

<!--themecolor js-->
<script src="/assets/js/themecolor.js"></script>

<!-- custom js -->
<script src="/assets/js/custom.js"></script>
@endsection