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
<div class="page-content"  id="halinput">
	    <div class="container-fluid">       
	
	        <div class="row">
	        	 @if (session('status'))
	        	 <div class="col-xl-12 dahsboard-column">
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                  </div>
                 @endif
                 @if($jumlahtotalresi > 500)
                  <div class="col-xl-12 dahsboard-column">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <b>Peringatan : </b><br>
                        Data resi sudah lebih dari 500 data segera lakukan <a href="{{url('/backup')}}">backup data</a>
                    </div>
                </div>
                @endif
                 @foreach($title as $row)
                 	@if($row->pengumuman!='')
	                 <div class="col-xl-12 dahsboard-column">
	                    <div class="alert alert-warning alert-dismissable">
	                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                <b>Pengumuman : </b><br>
	                                {!!$row->pengumuman!!}
						</div>
	                </div>
                	@endif
                @endforeach

                @if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
              	@if($jumlahpajakarmada > 0)
              	<div class="col-xl-12 dahsboard-column">
              		<section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title">List Pajak Armada Yang Akan Kadaluarsa</h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                    	<table id="table-sm" class="table table-bordered table-hover table-sm">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Unit</th>
							<th>Warna</th>
							<th>No.Polisi</th>
							<th>Nama Pajak</th>
							<th>Tanggal Kadaluarsa</th>
						</tr>
					</thead>
					<tbody>
						<?php $nopajak=1;?>
						@foreach($pajakarmada as $row)
						<tr>
							<td>{{$nopajak++}}</td>
							<td>{{$row->nama}}</td>
							<td>{{$row->warna}}</td>
							<td>{{$row->nopol}}</td>
							<td>{{$row->nama_pajak}}</td>
							<td>{{$row->tgl_kadaluarsa}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
	                    </div>
	                </section>
				<br>
			</div>
			@endif
			  	@endif

			  	@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2'|| Session::get('level') == '9'|| Session::get('level') == '6')
			  	@if($jmlkarya != $jmlabsen)
	        	<div class="col-xl-12 dahsboard-column">
	        		<section class="widget widget-simple-sm-fill green">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-users"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">{{$jmlabsen}} Karyawan Sudah Absen </div>
				<a href="{{url('/absen')}}" class="btn btn-rounded btn-inline btn-success-outline">Klik Untuk Absen</a>
					</section>
	        	</div>
	        	@endif
	        	@endif

	        	@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
	        	<div class="col-xl-4 dahsboard-column">
	        		@foreach($uanghariini as $rows)
					<section class="widget widget-simple-sm-fill">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-wallet"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">
									{{"Rp. ".number_format($rows->total,0,',','.')}}
								</div>
					</section>
					@endforeach
				</div>
				
	        	<div class="col-xl-4 dahsboard-column">
	        		<section class="widget widget-simple-sm-fill orange">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-page"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Resi Menunggu : {{$jumlahresi}}</div>
					</section>
	        	</div>
	        	<div class="col-xl-4 dahsboard-column">
	        		<section class="widget widget-simple-sm-fill red">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-clip"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Surat Jalan Menunggu : {{$jumlahsj}}</div>
					</section>
	        	</div>
				@endif
				<div class="col-xl-12 dashboard-column">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
								List Setoran BT Antar Cabang
							</div>
							<div class="card-body">
								<table class="table table-responsive table-stripped table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Cabang</th>
											<th>Resi</th>
											<th>Resi Jalan</th>
											<th>Nominal BT</th>
											<th> Aksi </th>											
										</tr>
									</thead>
									<tbody>
										@php
											$no=1;
										@endphp
										@foreach ($bt as $ibt)
											@if ($ibt->hit>0)
											<tr>												
												<td>{{$no++}}</td>
												<td>{{$ibt->nama}}</td>
												<td>{{$ibt->no_resi}}</td>
												<td>{{$ibt->kode}}</td>
												<td>Rp. {{number_format($ibt->totalbt)}}</td>
												@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2'|| Session::get('level') == '7')
												<td>
													<a href="{{url('bayar-bt').'/'.$ibt->kode}}" class="btn btn-outline-primary"> <i class="fa fa-eye-open"></i> Konfirmasi Uang Cabang</a>
												</td>
												@else
													<td>No Akses</td>
												@endif
											</tr>
											@else												
											<tr>
												<td align="center" colspan="6">Tidak Ada Data</td>
											</tr>										
											@endif											
										@endforeach
									</tbody>
								</table>
							</div>
							<div class="card-header">
								<div class="card-title">List Tanggungan Biaya BT</div>
							</div>
							<div class="card-body">
								<table class="table table-bordered table-responsive">
									<thead>
										<tr>
											<th>No</th>
											<th>Cabang</th>
											<th>Resi Jalan</th>
											<th>Nominal BT</th>																					
										</tr>
									</thead>
									<tbody>
										@php
											$nom=1;
										@endphp
										@foreach ($btb as $ibtb)											
											@if ($ibtb->hit>0)											
											<tr>
												<td>{{$nom++}}</td>
												<td>{{$ibtb->nama}} </td>
												<td>{{$ibtb->kode}}</td>
												<td>Rp. {{number_format($ibtb->totalbt)}}</td>
											</tr>
											@else
											<tr>
												<td align="center" colspan="5">Tidak ada Data</td>
											</tr>
											@endif											
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
	        	@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
	        	<div class="col-xl-12 dahsboard-column">
	        	<section class="card">
		            <header class="card-header">
		                Pengiriman Minggu Ini
		            </header>
		            <div class="card-block">
		                <div id="bar-chart"></div>
		            </div>
		        </section>
    			</div>
    			@endif

    			@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
	            <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title">Jumlah Resi Menunggu</h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                        <table class="tbl-typical">
	                            <tr>
	                                
	                                <th align="center"><div>No. Resi</div></th>
	                                <th><div>Admin</div></th>
	                                <th align="center"><div>Tanggal</div></th>
	                            </tr>
	                            @foreach($resi as $row)
	                            <tr>
	                            	<td>
	                                	<span class="label label-danger">
	                                	{{$row->no_resi}}
										</span>
	                                </td>
	                                <td>{{$row->admin}}</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">{{$row->tgl}}</span></td>
	                            </tr>
	                            @endforeach

	                        </table>
	                    </div>
	                </section>
	            </div>
	            @endif

	            @if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
	            <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title">List Surat Jalan Belum Lunas</h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                        <table class="tbl-typical">
	                            <tr>
	                                <th><div>Kode</div></th>
	                                <th><div>Admin</div></th>
	                                <th align="center"><div>Tanggal</div></th>
	                            </tr>
	                            @foreach($listsj as $row2)
	                            <tr>
	                                <td>
	                                    <span class="label label-danger">
	                                    	{{$row2->kode}}
	                                    </span>
	                                </td>
	                                <td>
	                                	{{$row2->admin}}
	                                </td>
	                                <td align="center">
	                                {{$row2->tgl}}
	                            	</td>
	                             </tr>
	                            @endforeach
	                        </table>
	                       
	                    </div>
	                </section>
	            </div>
				@endif				
	        </div>
	    </div>
	</div>
@endsection

@section('js')
<script src="{{asset('assets/js/lib/d3/d3.min.js')}}"></script>
<script src="{{asset('assets/js/lib/charts-c3js/c3.min.js')}}"></script>


<!-- <script src="{{asset('assets/js/custom/absen.js')}}"></script> -->

<script>
	$(document).ready(function() {
	var barChart = c3.generate({
        bindto: '#bar-chart',
        data: {
            columns: [
                ['Pengiriman',
            @php
	            $date = date('Y-m-d');
        		$waktu = strtotime($date);

			for ($i = 6; $i >= 0; $i--) {
				$minus = strtotime("-".$i." days", $waktu);
				$hasil = date('Y-m-d',$minus);
				$jumlah = DB::table('resi_pengiriman')->where([['tgl',$hasil]])->count();
				echo $jumlah.",";
			}
			@endphp
                ]
            ],
            type: 'bar'
        },axis: {
        x: {
            type: 'category',
            categories: [
            @php
	            $date = date('d-m-Y');
        		$waktu = strtotime($date);

			for ($i = 6; $i >= 0; $i--) {
				$minus = strtotime("-".$i." days", $waktu);
				$hasil = date('d-m-Y',$minus);
				echo "'".$hasil."',";
			}

			@endphp
            ]
        }
    },   
        bar: {
            width: {
                ratio: 0.5
            }
        }
    });

   
});

</script>
@endsection