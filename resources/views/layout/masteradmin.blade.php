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
<body class="with-side-menu">

	<header class="site-header">
	    <div class="container-fluid">
	        <a href="#" class="site-logo">
	            <img class="hidden-md-down" src="{{asset('img/LOGO2.PNG')}}" alt="">
	            <img class="hidden-lg-down" src="{{asset('img/LOGO2.PNG')}}" alt="">
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
	
	                    <button type="button" class="burger-right">
	                        <i class="font-icon-menu-addl"></i>
	                    </button>
	                </div><!--.site-header-shown-->
	
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header><!--.site-header-->

	<div class="mobile-menu-left-overlay"></div>
	<nav class="side-menu">
	    <ul class="side-menu-list">
	        <li class="grey">
	       	<a href="{{url('dashboard')}}">
	            <span>
	                <i class="font-icon font-icon-home"></i>
	                <span class="lbl">Home</span>
	            </span>
	        </a>
	        </li>
@if(Session::get('level') == 'programer' || Session::get('level') == 'superadmin')

	        <li class="blue">
	            <a href="{{url('admin')}}">
	                <i class="font-icon font-icon-user"></i>
	                <span class="lbl">Admin</span>
	               </a>
	        </li>
@endif
			<li class="red with-sub">
	            <span>
	                <i class="font-icon font-icon-users"></i>
	                <span class="lbl">Karyawan</span>
	            </span>
	            <ul>
	                <li><a href="{{url('jabatan')}}"><span class="lbl">Jabatan</span></a></li>
	                <li><a href="{{url('karyawan')}}">
	                	<span class="lbl">Data Karyawan</span></a>
	                </li>
	                
	            </ul>
	        </li>
			<!-- <li class="blue">
	            <a href="{{url('jabatan')}}">
	                <i class="font-icon font-icon-award"></i>
	                <span class="lbl">Jabatan</span>
	               </a>
	        </li>
	        <li class="blue">
	            <a href="{{url('karyawan')}}">
	                <i class="font-icon font-icon-users"></i>
	                <span class="lbl">Karyawan</span>
	               </a>
	        </li> 
	        <li class="green">
	            <a href="{{url('Manual')}}">
	                <i class="glyphicon glyphicon-list-alt"></i>
	                <span class="lbl">Manual</span>
	               </a>
	        </li>-->
	        <li class="magenta with-sub">
	        	<span>
	                <i class="font-icon font-icon-pencil"></i>
	                <span class="lbl">Resi Pengiriman</span>
	            </span>
	             <ul>
	             	<li>
	                	<a href="{{url('Manual')}}"><span class="lbl">Resi Manual</span></a>
	                </li>
                	<li>
                		<a href="{{url('/resipengirimandarat')}}"><span class="lbl">Pengiriman Darat</span></a>
                	</li>
	                <li>
	                	<a href="{{url('/resipengirimanlaut')}}"><span class="lbl">Pengiriman Laut</span></a>
	                </li>
	                <li>
	                	<a href="{{url('/resipengirimanudara')}}"><span class="lbl">Pengiriman Udara</span></a>
	                </li>
	            </ul>
	        </li>
	        <li class="green">
	            <a href="{{url('listpengiriman')}}">
	                <i class="fa fa-list-alt"></i>
	                <span class="lbl">List Pengiriman</span>
	            </a>
	        </li>
	        <li class="brown with-sub">
	        	<span>
	                <i class="fa fa-bus"></i>
	                <span class="lbl">Surat Jalan</span>
	            </span>
	             <ul>
                <li><a href="{{url('/buatsuratjalan')}}"><span class="lbl">Buat Surat Jalan</span></a></li>
	                <li><a href="{{url('/listsuratjalan')}}"><span class="lbl">
	                Daftar Surat Jalan </span></a></li>
	                <!--<li><a href="#"><span class="lbl">Pengiriman Udara</span></a></li> -->
	            </ul>
	        </li>
	        
	        <li class="magenta with-sub">
	            <span>
	                <span class="fa fa-money"></span>
	                <span class="lbl">Tarif Pengiriman</span>
	            </span>
	            <ul>
	                <li>
	                	<a href="{{url('trfdarat')}}"><span class="lbl">Tarif Darat</span></a>
	                </li>

	                <li>
	                	<a href="{{url('trflaut')}}"><span class="lbl">Tarif Laut</span></a>
	                </li>

	                <li class="with-sub">
	                    <span>
	                        <span class="lbl">Udara</span>
	                    </span>
	                    <ul>
	                        <li>
	                        	<a href="{{url('trfudara')}}"><span class="lbl">Tarif Udara</span></a>
	                        </li>
	                        <li><a href="{{url('kat_bar')}}"><span class="lbl">Special Charge</span></a></li>
	                       
	                    </ul>
	                </li>
	            </ul>
	        </li>
	        <!-- <li class="green">
	            <a href="{{url('kat_bar')}}">
	                <i class="font-icon font-icon-list-square"></i>
	                <span class="lbl">Kategori Barang</span>
	            </a>
	        </li>
	        <li class="red">
	            <a href="{{url('trfdarat')}}">
	                <i class="fa fa-truck"></i>
	                <span class="lbl">Tarif Darat</span>
	            </a>
	        </li>
	        <li class="pink">
	            <a href="{{url('trflaut')}}">
	                <i class="font-icon font-icon-help"></i>
	                <span class="lbl">Tarif Laut</span>
	            </a>
	        </li>
	        <li class="mageta">
	            <a href="{{url('trfudara')}}">
	                <i class="fa fa-plane"></i>
	                <span class="lbl">Tarif Udara</span>
	            </a>
	        </li> -->
	        <li class="red">
	            <a href="{{url('vendor')}}">
	                <i class="fa fa-users"></i>
	                <span class="lbl">Vendor</span>
	            </a>
	        </li>
	        <li class="blue">
	            <a href="{{url('pengeluaranlain')}}">
	                <i class="fa fa-external-link"></i>
	                <span class="lbl">Pengeluaran Lainya</span>
	            </a>
	        </li>
	        <li class="green with-sub">
	            <span>
	                <i class="fa fa-file"></i>
	                <span class="lbl">Laporan</span>
	            </span>
	            <ul>
	                <li>
	                	<a href="{{url('/laporanpemasukan')}}"><span class="lbl">
		                Laporan Pemasukan</span></a>
	                	
	                </li>
	                <li class="with-sub">
	                    <span>
	                        <span class="lbl">Laporan Pengeluaran</span>
	                    </span>
	                    <ul>
	                        <li><a href="{{url('/laporanpengeluarangjkw')}}"><span class="lbl">Gaji Karyawan</span></a></li>

	                        <li><a href="{{url('/laporanpengeluaran')}}"><span class="lbl">Vendor</span></a></li>

	                        <li>
	                        	<a href="{{url('/laporanpengeluaranlainya')}}"><span class="lbl">Lainya</span></a>
	                        </li>
	                        <li>
	                        	<a href="{{url('/pajak')}}"><span class="lbl">Pajak</span></a>
	                        </li>
	                    </ul>
	                </li>
	                <li>
	                	<a href="{{url('/omset')}}"><span class="lbl">
		                Omset</span></a>
	                	
	                </li>
	            </ul>
	        </li>
	        @if(Session::get('level') == 'programer' || Session::get('level') == 'superadmin')
	        <li class="red">
	            <a href="{{url('backup')}}">
	                <i class="fa fa-download"></i>
	                <span class="lbl">Backup</span>
	            </a>
	        </li>
	        
	        <li class="brown">
	            <a href="{{url('setting')}}">
	                <i class="font-icon font-icon-cogwheel"></i>
	                <span class="lbl">Setting</span>
	            </a>
	        </li>
	       @endif
	    </ul>
	

	</nav>
	
	@yield('content')	
	<!-- <div class="page-content">
		<div class="container-fluid">
		</div>
	</div> -->

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