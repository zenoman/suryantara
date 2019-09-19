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
			//document.getElementById('logout-form').submit();
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
	                
	
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            <img src="{{asset('assets/img/avatar-2-64.png')}}" alt="">{{Auth::user()->username}}
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                        	 <span class="dropdown-item text-center text-muted">{{Session::get('statusadmin')}}</span>
	                        	 <div class="dropdown-divider"></div>
	                        	 @if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
	                        	  <a class="dropdown-item" href="{{url('backup')}}"><span class="font-icon font-icon-download"></span>Back Up Data</a>
	                        	  <a class="dropdown-item" href="{{url('setting')}}"><span class="font-icon font-icon-cogwheel"></span>Setting Web</a>
	                        	  <div class="dropdown-divider"></div>
	                        	  @endif
	                        	
	                            <a class="dropdown-item" href="{{url('admin/'.Session::get('id').'/edit')}}"><span class="font-icon font-icon-user"></span>Edit Profile</a>

	                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
	                        </div>
	                    </div>
	                </div>
					 <div class="mobile-menu-right-overlay"></div>
	                
	        </div>
	    </div>
	</header>
	<div class="mobile-menu-left-overlay"></div>
	<ul class="main-nav nav nav-inline">
		<li class="nav-item">
			<a class="nav-link" href="{{url('dashboard')}}">Home</a>
		</li>
		<li class="nav-item dropdown">
			@if(Session::get('level') == '1' 
			|| Session::get('level') == '3'
			|| Session::get('level') == '5'
			|| Session::get('level') == '2'
			|| Session::get('level') == '9')
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Master Data</a>
			@endif
			<div class="dropdown-menu">
				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '5')
				<a class="dropdown-item" href="{{url('jabatan')}}">Data Jabatan</a>
				@endif
				
				@if(Session::get('level') == '1' || Session::get('level') == '3'|| Session::get('level') == '5')
				<a class="dropdown-item" href="{{url('karyawan')}}">Data Karyawan</a>
				<div class="dropdown-divider"></div>
				@endif

				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
				<a class="dropdown-item" href="{{url('admin')}}">Data Admin</a>
				<div class="dropdown-divider"></div>
				@endif

				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
				<a class="dropdown-item" href="{{url('vendor')}}">Data Vendor</a>
				@endif

				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
				<a class="dropdown-item" href="{{url('mitra')}}">Data Mitra</a>
				<div class="dropdown-divider"></div>
				@endif

				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9')
				<a class="dropdown-item" href="{{url('trfdarat')}}">Tarif Darat</a>
				@endif

				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9'|| Session::get('level') == '6')
				<a class="dropdown-item" href="{{url('trfcity')}}">Tarif City Kurier</a>
				@endif

				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9'|| Session::get('level') == '6')
				<a class="dropdown-item" href="{{url('trflaut')}}">Tarif Laut</a>
				@endif

				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9'|| Session::get('level') == '6')
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Tarif Udara</a>
				@endif
				
				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9'|| Session::get('level') == '6')
				<div class="dropdown-menu">
					<a class="dropdown-item" href="{{url('trfudara')}}">Tarif Udara</a>
					<a class="dropdown-item" href="{{url('kat_bar')}}">Special Charge</a>
				</div>
				<div class="dropdown-divider"></div>
				@endif

				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
				<a class="dropdown-item" href="{{url('/armada')}}">Data Armada</a>
				<div class="dropdown-divider"></div>
				@endif

				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
				<a class="dropdown-item" href="{{url('cabang')}}">Data Cabang</a>

				@endif

				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
				<a class="dropdown-item" href="{{url('setting-pajak')}}">Setting Pajak Dan Saldo Akhir</a>
				@endif
			</div>
		</li>
		<li class="nav-item dropdown">
			@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9'|| Session::get('level') == '4')
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Resi Pengiriman</a>
			@endif
			<div class="dropdown-menu">
				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
				<a class="dropdown-item" href="{{url('distribusiresi')}}">Distribusi Resi Manual</a>
				@endif
				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9'|| Session::get('level') == '4')
				<a class="dropdown-item" href="{{url('Manual')}}">Input Manual</a>
				@endif

				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9'|| Session::get('level') == '4')
				<a class="dropdown-item" href="{{url('/resipengirimandarat')}}">Pengiriman Darat</a>
				@endif

				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9'|| Session::get('level') == '4')
				<a class="dropdown-item" href="{{url('/resipengirimanlaut')}}">Pengiriman Laut</a>
				@endif

				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9'|| Session::get('level') == '4')
				<a class="dropdown-item" href="{{url('/resipengirimanudara')}}">Pengiriman Udara</a>
				<div class="dropdown-divider"></div>
				@endif


				
				@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9'|| Session::get('level') == '4')
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">City Kurier</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="{{url('resicitykurier')}}">
									Personal</a>
					<a class="dropdown-item" href="{{url('resicitykuriercompany')}}">
									Company</a>
				</div>
				@endif
				
			</div>
		</li>
		@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9'|| Session::get('level') == '7'|| Session::get('level') == '4' || Session::get('level') == '8')
		<li class="nav-item">
			<a class="nav-link " href="{{url('listpengiriman')}}">List Pengiriman</a>
		</li>
		@endif
		@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9'|| Session::get('level') == '7' || Session::get('level') == '8')
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Manifest</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('/buatsuratjalan')}}">Buat Manifest Vendor</a>
				<a class="dropdown-item" href="{{url('/buatsuratjalancabang')}}">Buat Manifest Cabang</a>
				<a class="dropdown-item" href="{{url('/listsuratjalan')}}">Daftar Manifest</a>
				
			</div>
		</li>
		@endif
		@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9'|| Session::get('level') == '7' || Session::get('level') == '8')
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Penerimaan</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('inputpenerimaan')}}">Inbon</a>
				<a class="dropdown-item" href="{{url('listpenerimaan')}}">List Penerimaan</a>
				<a class="dropdown-item" href="{{url('listtransit')}}">Transit</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="{{url('/tambahantaran')}}">Antaran</a>
				<a class="dropdown-item" href="{{url('/listantaran')}}">Daftar Antaran</a>
				<a class="dropdown-item" href="{{url('/inputpod')}}">Input Paket POD</a>
			</div>
		</li>		
		@endif
		@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9')
		<li class="nav-item">
			<a href="{{url('pembukuan')}}" class="nav-link">Pembukuan</a>
		</li>
		@endif

		@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2' || Session::get('level') == '9')
		<li class="nav-item">
			<a href="{{url('/envoice')}}" class="nav-link">Invoice</a>

		</li>	
		@endif

		@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
		<li class="nav-item">
			<a href="{{url('rekap-laporan')}}" class="nav-link">Rekap Laporan</a>
		</li>

		@endif
		@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Omset</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{url('')}}" class="nav-link">Omset Cabang</a>
				<a class="dropdown-item" href="{{url('')}}" class="nav-link">Omset Semua Cabang</a>
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