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
	
	                    <button type="button" class="burger-right">
	                        <i class="font-icon-menu-addl"></i>
	                    </button>
	                </div><!--.site-header-shown-->
	
	                <div class="mobile-menu-right-overlay"></div>
	                <!--.site-header-collapsed-->
	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header><!--.site-header-->
	<div class="mobile-menu-left-overlay"></div>
	<ul class="main-nav nav nav-inline">
		<li class="nav-item">
			<a class="nav-link" href="{{url('dashboard')}}">Home</a>
		</li>
		@if(Session::get('level') == 'programer' || Session::get('level') == 'superadmin')
			<li class="nav-item">
	            <a href="{{url('admin')}}" class="nav-link" >
	                Admin
	            </a>
	        </li>
		@endif
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Karyawan</a>
			<div class="dropdown-menu">
				<a href="{{url('jabatan')}}" class="dropdown-item">Jabatan</a>
				<a href="{{url('karyawan')}}" class="dropdown-item">Data Karyawan</a>
				
			</div>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Resi Pengiriman</a>
			<div class="dropdown-menu">
				<a href="{{url('Manual')}}" class="dropdown-item">Input Manual</a>
				<div class="dropdown-divider"></div>
				<a href="{{url('/resipengirimandarat')}}" class="dropdown-item">Pengiriman Darat</a>
				<a href="{{url('/resipengirimanlaut')}}" class="dropdown-item">Pengiriman Laut</a>
				<a href="{{url('/resipengirimanudara')}}" class="dropdown-item">Pengiriman Udara</a>
				<div class="dropdown-divider"></div>
				<a href="{{url('listpengiriman')}}" class="dropdown-item">
	                List Pengiriman
	            </a>
			</div>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Surat Jalan</a>
			<div class="dropdown-menu">
				<a href="{{url('/buatsuratjalan')}}" class="dropdown-item">Buat Surat Jalan</a>
				<a href="{{url('/listsuratjalan')}}" class="dropdown-item">
	                Daftar Surat Jalan</a>
			</div>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Tarif Pengiriman</a>
			<div class="dropdown-menu">
				<a href="{{url('trfdarat')}}" class="dropdown-item">Tarif Darat</a>
				<a href="{{url('trflaut')}}" class="dropdown-item">Tarif Laut</a>
				<a href="{{url('trfudara')}}" class="dropdown-item">Tarif Udara</a>
				<div class="dropdown-divider"></div>
				<a href="{{url('kat_bar')}}" class="dropdown-item">Special Charge</a>
			</div>
		</li>
		 <li class="nav-item">
	            <a href="{{url('vendor')}}" class="nav-link">
	                Vendor
	            </a>
	        </li>
	        <li class="nav-item">
	            <a href="{{url('pengeluaranlain')}}" class="nav-link">Pengeluaran Lain
	            </a>
	        </li>
	        <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Laporan</a>
			<div class="dropdown-menu">
				<a href="{{url('/laporanpemasukan')}}" class="dropdown-item">Laporan Pemasukan</a>
				<div class="dropdown-divider"></div>
				<a href="{{url('/laporanpengeluarangjkw')}}" class="dropdown-item">Gaji Karyawan</a>
				<a href="{{url('/laporanpengeluaran')}}" class="dropdown-item">Vendor</a>
				<a href="{{url('/laporanpengeluaranlainya')}}" class="dropdown-item">Lainya</a>
				<a href="{{url('/pajak')}}" class="dropdown-item">Pajak</a>
				<div class="dropdown-divider"></div>
	            <a href="{{url('/omset')}}" class="dropdown-item">Omset</a>
			</div>
		</li>
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