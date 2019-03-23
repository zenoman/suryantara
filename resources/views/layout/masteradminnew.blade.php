@if(!Session::get('username'))
<script type="text/javascript">
    window.location.href = '{{url("login")}}';
</script>
@endif
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	@yield('header')
	@yield('css')

	<link href="{{asset('assets/img/favicon.144x144.png')}}" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="{{asset('assets/img/favicon.114x114.png')}}" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="{{asset('assets/img/favicon.72x72.png')}}" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="{{asset('assets/img/favicon.57x57.png')}}" rel="apple-touch-icon" type="image/png">
	<link href="{{asset('assets/img/favicon.png')}}" rel="icon" type="image/png">
	<link href="{{asset('assets/img/favicon.ico')}}" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    <link rel="stylesheet" href="{{asset('assets/css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
</head>

<body class="horizontal-navigation">

	<header class="site-header">
	    <div class="container-fluid">
	        <a href="#" class="site-logo">
	            <img class="hidden-md-down" src="{{asset('img/LOGO2.png')}}" alt="">
	            <img class="hidden-lg-down" src="{{asset('img/LOGO2.png')}}" alt="">
	        </a>
	
	        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
	            <span>toggle menu</span>
	        </button>
	
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>
	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            <img src="{{asset('assets/img/avatar-2-64.png')}}" alt="">
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            <a class="dropdown-item" href="{{url('admin/'.Session::get('id').'/edit')}}"><span class="font-icon font-icon-user"></span>Edit Profile</a>

	                            <a class="dropdown-item" href="{{url('/login/logout')}}"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
	                        </div>
	                    </div>
	                </div><!--.site-header-shown-->
	                	<div class="dropdown">
	                            <button class="btn btn-rounded dropdown-toggle" id="dd-header-add" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                                <i class="glyphicon glyphicon-list-alt"></i>
	                            </button>
	                            <div class="dropdown-menu" aria-labelledby="dd-header-add">
	                                <a class="dropdown-item" href="{{url('/laporanpemasukan')}}">Laporan Pemasukan </a>
	        <span class="nav-link dropdown-toggle" data-toggle="dropdown">Laporan Pengeluaran</span>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('/laporanpengeluarangjkw')}}">Gaji Karyawan</a>
				<a class="dropdown-item" href="{{url('/laporanpengeluaran')}}">Vendor</a>
				<a class="dropdown-item" href="{{url('/laporanpengeluaranlainya')}}">Lainya</a>
				<a class="dropdown-item" href="{{url('/pajak')}}">Pajak</a>
			</div>

	                                <a class="dropdown-item" href="{{url('/omset')}}">omset</a>
	                            </div>
	                            @if(Session::get('level') == 'programer' || Session::get('level') == 'superadmin')
	                            <a href="{{url('backup')}}"><button class="btn btn-rounded" id="dd-header-add" type="button" aria-haspopup="true" aria-expanded="false">
	                                <i class="glyphicon glyphicon-cloud-download"></i>
	                            </button></a>
	                            <a href="{{url('setting')}}"><button class="btn btn-rounded" id="dd-header-add" type="button" aria-expanded="false">
	                                <i class="font-icon font-icon-cogwheel"></i>
	                            </button></a>
	                            @endif
	                        </div>


	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header><!--.site-header-->
	<div class="mobile-menu-left-overlay"></div>
	<ul class="main-nav nav nav-inline">
		<li class="nav-item">
			<a class="nav-link active" href="{{url('dashboard')}}">Home</a>
		</li>
		@if(Session::get('level') == 'programer' || Session::get('level') == 'superadmin')
		<li class="nav-item">
			<a class="nav-link" href="{{url('admin')}}">Admin</a>
		</li>
		@endif
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Karyawan</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('jabatan')}}">Jabatan</a>
				<a class="dropdown-item" href="{{url('karyawan')}}">Data Karyawan</a>
				<!-- <div class="dropdown-divider"></div> -->
				<!-- <a class="dropdown-item" href="#">cokkkkkk</a> -->
			</div>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Resi Pengiriman</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('Manual')}}">Input Manual</a>
				<a class="dropdown-item" href="{{url('/resipengirimandarat')}}">Pengiriman Darat</a>
				<a class="dropdown-item" href="{{url('/resipengirimanlaut')}}">Pengiriman Laut</a>
				<a class="dropdown-item" href="{{url('/resipengirimanudara')}}">Pengiriman Udara</a>
				<!-- <div class="dropdown-divider"></div> -->
				<!-- <a class="dropdown-item" href="#">cokkkkkk</a> -->
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link " href="{{url('listpengiriman')}}">List Pengiriman</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Surat Jalan</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('/buatsuratjalan')}}">Buat Suarat Jalan</a>
				<a class="dropdown-item" href="{{url('/listsuratjalan')}}">Daftar Surat Jalan</a>
			</div>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Tarif Pengiriman</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('trfdarat')}}">Tarif Darat</a>
				<a class="dropdown-item" href="{{url('trflaut')}}">Tarif Laut</a>
	<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Udara</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('trfudara')}}">Tarif Udara</a>
				<a class="dropdown-item" href="{{url('kat_bar')}}">Special Charge</a>
			</div>
			</div>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="{{url('vendor')}}">Vendor</a>
		</li>
		
		<li class="nav-item">
			<a class="nav-link" href="{{url('pengeluaranlain')}}">Pengeluaran Lainya</a>
		</li>
		<!--
 		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Laporan</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('/laporanpemasukan')}}">Laporan Pemasukan</a>
	<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Laporan Pengeluaran</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('/laporanpengeluarangjkw')}}">Gaji Karyawan</a>
				<a class="dropdown-item" href="{{url('/laporanpengeluaran')}}">Vendor</a>
				<a class="dropdown-item" href="{{url('/laporanpengeluaranlainya')}}">Lainya</a>
				<a class="dropdown-item" href="{{url('/pajak')}}">Pajak</a>
			</div>
			<a class="dropdown-item" href="{{url('/omset')}}">Omset</a>
			</div>
		</li>
		@if(Session::get('level') == 'programer' || Session::get('level') == 'superadmin')
		<li class="nav-item">
			<a class="nav-link" href="{{url('backup')}}">Backup</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{url('setting')}}">Setting</a>
		</li>
		@endif -->
	</ul>

@yield('content')
	
	<script src="{{asset('assets/js/lib/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('assets/js/lib/popper/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/lib/tether/tether.min.js')}}"></script>
	<script src="{{asset('assets/js/lib/bootstrap/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/plugins.js')}}"></script>

	<script type="text/javascript" src="{{asset('assets/js/lib/jqueryui/jquery-ui.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/js/lib/lobipanel/lobipanel.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/js/lib/match-height/jquery.matchHeight.min.js')}}"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script>
		$(document).ready(function(){
			try {
				$('.panel').lobiPanel({
					sortable: true
				}).on('dragged.lobiPanel', function(ev, lobiPanel){
					$('.dahsboard-column').matchHeight();
				});
			} catch (err) {}

			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
				var dataTable = new google.visualization.DataTable();
				dataTable.addColumn('string', 'Day');
				dataTable.addColumn('number', 'Values');
				// A column for custom tooltip content
				dataTable.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
				dataTable.addRows([
					['MON',  130, ' '],
					['TUE',  130, '130'],
					['WED',  180, '180'],
					['THU',  175, '175'],
					['FRI',  200, '200'],
					['SAT',  170, '170'],
					['SUN',  250, '250'],
					['MON',  220, '220'],
					['TUE',  220, ' ']
				]);

				var options = {
					height: 314,
					legend: 'none',
					areaOpacity: 0.18,
					axisTitlesPosition: 'out',
					hAxis: {
						title: '',
						textStyle: {
							color: '#fff',
							fontName: 'Proxima Nova',
							fontSize: 11,
							bold: true,
							italic: false
						},
						textPosition: 'out'
					},
					vAxis: {
						minValue: 0,
						textPosition: 'out',
						textStyle: {
							color: '#fff',
							fontName: 'Proxima Nova',
							fontSize: 11,
							bold: true,
							italic: false
						},
						baselineColor: '#16b4fc',
						ticks: [0,25,50,75,100,125,150,175,200,225,250,275,300,325,350],
						gridlines: {
							color: '#1ba0fc',
							count: 15
						},
					},
					lineWidth: 2,
					colors: ['#fff'],
					curveType: 'function',
					pointSize: 5,
					pointShapeType: 'circle',
					pointFillColor: '#f00',
					backgroundColor: {
						fill: '#008ffb',
						strokeWidth: 0,
					},
					chartArea:{
						left:0,
						top:0,
						width:'100%',
						height:'100%'
					},
					fontSize: 11,
					fontName: 'Proxima Nova',
					tooltip: {
						trigger: 'selection',
						isHtml: true
					}
				};

				var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
				chart.draw(dataTable, options);
			}
			$(window).resize(function(){
				drawChart();
				setTimeout(function(){
				}, 1000);
			});
		});
	</script>
		@yield('js')
	<script src="{{asset('assets/js/app.js')}}"></script>
		@yield('otherjs')
</body>
</html>