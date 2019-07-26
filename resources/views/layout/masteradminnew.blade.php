@if(!Session::get('username'))
<script type="text/javascript">
    window.location.href = '{{url("login")}}';
</script>
@else
	@if(Session::get('statuslogin')!='aktiv')
	<script type="text/javascript">
    window.location.href = '{{url("lockscreen")}}';
	</script>
	@endif
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
	<link rel="stylesheet" href="{{asset('assets/css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
	<script language = "javascript">
	function idlelogout() {
		var t;
		window.onload 		= resetTimer;
		window.onmousemove 	= resetTimer;
		window.onmousedown 	= resetTimer;
		window.onclick 		= resetTimer;
		window.onscroll 	= resetTimer;
		window.onkeypress 	= resetTimer;

		function logout() {
			window.location.href='{{url("lockscreen")}}';
			}

		function resetTimer(){
			clearTimeout(t);
			t = setTimeout(logout,180000);
			}

		}
		idlelogout();
	</script>

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
	                
	                        <div class="dropdown dropdown-notification messages">
	                            @if(Session::get('level') == 'programer' || Session::get('level') == 'superadmin')
	                            <a href="{{url('backup')}}" class="btn btn-rounded">
	                                <i class="glyphicon glyphicon-cloud-download"></i>
	                            </a>
	                            <a href="{{url('setting')}}" class="btn btn-rounded">
	                                <i class="font-icon font-icon-cogwheel"></i></a>
	                            @endif
	                        </div>
	
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            <img src="{{asset('assets/img/avatar-2-64.png')}}" alt="">
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            <a class="dropdown-item" href="{{url('admin/'.Session::get('id').'/edit')}}"><span class="font-icon font-icon-user"></span>Edit Profile</a>

	                            <a class="dropdown-item" href="{{url('/login/logout')}}"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
	                        </div>
	                    </div>
	
	                    <button type="button" class="burger-right">
	                        <i class="font-icon-menu-addl"></i>
	                    </button>
	                </div><!--.site-header-shown-->
	
	                <div class="mobile-menu-right-overlay"></div>
	                <div class="site-header-collapsed">
	                    <div class="site-header-collapsed-in">
	                        <div class="dropdown dropdown-typical">
	                        	@if(Session::get('level') == 'programer' || Session::get('level') == 'superadmin' || Session::get('level') == 'admin')
	                <div class="dropdown dropdown-typical">
	                <a class="dropdown-toggle" id="dd-header-marketing" data-target="#" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                    <span class="font-icon font-icon-cogwheel"></span>
	                    <span class="lbl">Akutansi</span>
	                </a>
	
	                <div class="dropdown-menu" aria-labelledby="dd-header-marketing">
	                    <a class="dropdown-item" href="{{url('/kat_akut')}}">kategori Akutansi</a>
	                    <a class="dropdown-item" href="{{url('/nyusut')}}">Penyusutan</a>
	                    <a class="dropdown-item" href="{{url('/laporakun')}}">Laporan</a>
	                    <a class="dropdown-item" href="{{url('/laporakundet')}}">Detail Laporan</a>
	                    <a class="dropdown-item" href="{{url('/labarugi')}}">Laba Rugi</a>
	                    <a class="dropdown-item" href="{{url('/neraca')}}">Neraca</a>
	                </div>
	            </div>
				@endif
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</header>
	<div class="mobile-menu-left-overlay"></div>
	<ul class="main-nav nav nav-inline">
		<li class="nav-item">
			<a class="nav-link" href="{{url('dashboard')}}">Home</a>
		</li>
		@if(Session::get('level') == 'programer' || Session::get('level') == 'superadmin')
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Master Data</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('jabatan')}}">Data Jabatan</a>
				<a class="dropdown-item" href="{{url('karyawan')}}">Data Karyawan</a>
				
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="{{url('admin')}}">Data Admin</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="{{url('vendor')}}">Data Vendor</a>
				<div class="dropdown-divider"></div>
				 <span class="nav-link dropdown-toggle" data-toggle="dropdown">Inventaris</span>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('/armada')}}">Armada</a>
				
			</div><p></p>
				@if(Session::get('level') == 'programer')
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="{{url('cabang')}}">Data Cabang</a>

				@endif
			</div>
		</li>
		@endif
		
		@if(Session::get('level') == 'programer' || Session::get('level') == 'superadmin' || Session::get('level') == 'admin' || Session::get('level') == 'cs')
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Resi Pengiriman</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('Manual')}}">Input Manual</a>
				<a class="dropdown-item" href="{{url('/resipengirimandarat')}}">Pengiriman Darat</a>
				<a class="dropdown-item" href="{{url('/resipengirimanlaut')}}">Pengiriman Laut</a>
				<a class="dropdown-item" href="{{url('/resipengirimanudara')}}">Pengiriman Udara</a>
				<a class="dropdown-item" href="{{url('/resipengirimancitykurier')}}">City Kurier</a>
				
			</div>
		</li>
		@endif
		@if(Session::get('level') == 'programer' || Session::get('level') == 'superadmin' || Session::get('level') == 'admin' || Session::get('level')=='cs')
		<li class="nav-item">
			<a class="nav-link " href="{{url('listpengiriman')}}">List Pengiriman</a>
		</li>
		@endif
		@if(Session::get('level') == 'programer' || Session::get('level') == 'superadmin' || Session::get('level') == 'admin' || Session::get('level')=='operasional')
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Manifest</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('/buatsuratjalan')}}">Buat Manifest</a>
				<a class="dropdown-item" href="{{url('/listsuratjalan')}}">Daftar Manifest</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="{{url('/tambahantaran')}}">Buat Manifest Antar</a>
				<a class="dropdown-item" href="{{url('/listantaran')}}">Daftar Manifest Antar</a>
			</div>
		</li>
		@endif
		@if(Session::get('level') == 'programer' || Session::get('level') == 'superadmin' || Session::get('level') == 'admin')
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
		@endif
		@if(Session::get('level') == 'programer' || Session::get('level') == 'superadmin' || Session::get('level') == 'admin')
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Pembukuan</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('pengeluaranlain')}}">Pengeluaran Harian</a>
				<a class="dropdown-item" href="{{url('/modal')}}">Modal</a>
				<a class="dropdown-item" href="{{url('pajak')}}">Pajak Perusahaan</a>
				<a class="dropdown-item" href="{{url('/pilihabsensi')}}">Laporan Absensi</a>
				<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{url('/laporanpemasukan')}}">Pemasukan</a>
	        <span class="nav-link dropdown-toggle" data-toggle="dropdown">Pengeluaran</span>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('/laporanpengeluarangjkw')}}">Gaji Karyawan</a>
				<a class="dropdown-item" href="{{url('/laporanpengeluaran')}}">Vendor</a>
				<a class="dropdown-item" href="{{url('/laporanpengeluaranlainya')}}">Lainya</a>
				<!-- <a class="dropdown-item" href="{{url('/pajak')}}">Pajak Perusahaan</a> -->
			</div><p></p>
	                                <!-- <a class="dropdown-item" href="{{url('/omset')}}">omset</a> -->
			
			</div>
		</li>
		@endif
	</ul>

@yield('content')
	<script src="{{asset('assets/js/lib/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('assets/js/lib/popper/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/lib/tether/tether.min.js')}}"></script>
	<script src="{{asset('assets/js/lib/bootstrap/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/plugins.js')}}"></script>
	
		@yield('js')
	<script src="{{asset('assets/js/app.js')}}"></script>
		@yield('otherjs')
</body>
</html>