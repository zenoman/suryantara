@extends('layout.masteradminnew')
@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('css')
<link href="{{asset('assets/css/lib/charts-c3js/c3.min.css')}}" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="{{asset('assets/css/lib/lobipanel/lobipanel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/lobipanel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/lib/jqueryui/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/pages/widgets.min.css')}}">
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
                <div class="section-header">
                        <div class="tbl">
                            <div class="tbl-row">
                                <div class="tbl-cell">
                                    <h3>Halaman Saldo</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row">                    
                    <div class="col-xl-3 dahsboard-column">
                            <section class="widget widget-simple-sm">
                                <div class="widget-simple-sm-icon">
                                    <i class="font-icon font-icon-zigzag "></i>
                                </div>
                                <div class="widget-simple-sm-bottom">
                                <a href="{{url('pembukuan-transfer')}}" class="btn btn-success btn-block">Transfer</a>
                                </div>
                            </section><!--.widget-simple-sm-->
                    </div> 
                    <div class="col-xl-3 dahsboard-column">
                            <section class="widget widget-simple-sm">
                                <div class="widget-simple-sm-icon">
                                    <i class="font-icon font-icon-refresh "></i>
                                </div>
                                <div class="widget-simple-sm-bottom">
                                    <a href="{{url('/kat_akut')}}" class="btn btn-success btn-block">Kategori Akuntansi</a>
                                </div>
                            </section><!--.widget-simple-sm-->
                    </div> 
                    <div class="col-xl-3 dahsboard-column">
                        <section class="widget widget-simple-sm">
                            <div class="widget-simple-sm-icon">
                                <i class="font-icon font-icon-alarm "></i>
                            </div>
                            <div class="widget-simple-sm-bottom">
                                <a href="{{url('/laporanpengeluarangjkw')}}" class="btn btn-success btn-block">Gaji Karyawan</a>
                            </div>
                        </section><!--.widget-simple-sm-->
                </div> 
                </div>
            <div class="section-header">
                <div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Halaman Pembukuan </h3>
						</div>
					</div>
				</div>
            </div>
            <div class="row">
                <div class="col-xl-3 dahsboard-column">
                    <section class="widget widget-simple-sm">
                        <div class="widget-simple-sm-icon">
                            <i class="font-icon font-icon-list-square "></i>
                        </div>
                        <div class="widget-simple-sm-bottom">
                            <a href="{{url('pengeluaranlain')}}" class="btn btn-primary btn-block">Input Pengeluaran Lain</a>
                        </div>
                    </section><!--.widget-simple-sm-->
                </div>    
                <div class="col-xl-3 dahsboard-column">
                    <section class="widget widget-simple-sm">
                        <div class="widget-simple-sm-icon">
                            <i class="font-icon font-icon-bookmark"></i>
                        </div>
                        <div class="widget-simple-sm-bottom">
                            <a href="{{url('/laporakun')}}" class="btn btn-primary btn-block">Laporan Pengeluaran Lain</a>
                        </div>
                    </section><!--.widget-simple-sm-->
                </div>
                <div class="col-xl-3 dahsboard-column">
                    <section class="widget widget-simple-sm">
                        <div class="widget-simple-sm-icon">
                            <i class="font-icon font-icon-calend"></i>
                        </div>
                        <div class="widget-simple-sm-bottom">
                            <a href="{{url('/laporakundet')}}" class="btn btn-primary btn-block">Laporan Detail </a>
                        </div>
                    </section><!--.widget-simple-sm-->
                </div>
                <div class="col-xl-3 dahsboard-column">
                    <section class="widget widget-simple-sm">
                        <div class="widget-simple-sm-icon">
                            <i class="font-icon font-icon-archive"></i>
                        </div>
                        <div class="widget-simple-sm-bottom">
                            <a href="{{url('/neraca')}}" class="btn btn-primary btn-block"> Neraca </a>
                        </div>
                    </section><!--.widget-simple-sm-->
                </div>   
                <div class="col-xl-3 dahsboard-column">
                        <section class="widget widget-simple-sm">
                            <div class="widget-simple-sm-icon">
                                <i class="font-icon font-icon-picture-2"></i>
                            </div>
                            <div class="widget-simple-sm-bottom">
                                <a href="{{url('/nyusut')}}" class="btn btn-primary btn-block"> Penyusutan </a>
                            </div>
                        </section><!--.widget-simple-sm-->
                    </div>    
                    <div class="col-xl-3 dahsboard-column">
                            <section class="widget widget-simple-sm">
                                <div class="widget-simple-sm-icon">
                                    <i class="font-icon font-icon-check-circle"></i>
                                </div>
                                <div class="widget-simple-sm-bottom">
                                    <a href="{{url('/labarugi')}}" class="btn btn-primary btn-block"> Laba Rugi </a>
                                </div>
                            </section><!--.widget-simple-sm-->
                        </div>   
                    <div class="col-xl-3 dahsboard-column">
                        <section class="widget widget-simple-sm">
                            <div class="widget-simple-sm-icon">
                                <i class="font-icon font-icon-contacts"></i>
                            </div>
                            <div class="widget-simple-sm-bottom">
                                <a href="{{url('/pilihabsensi')}}" class="btn btn-primary btn-block"> Absensi </a>
                            </div>
                        </section><!--.widget-simple-sm-->
                    </div>   
            </div>                 
        </div>
    </div>
@endsection