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
	       
	
	        <div class="row">
	        	 @if (session('status'))
	        	 <div class="col-xl-12 dahsboard-column">
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                </div>
                    @endif
                @if($jumlahpajakarmada > 0)
                    <div class="col-xl-12 dahsboard-column">
	                <section class="card card-red">
				<header class="card-header">
					Peringatan Pajak Kendaraan
				</header>
				<div class="card-block">
					<table id="table-edit" class="table table-bordered table-hover">
				<thead>
				<tr>
					<th>No</th>
					<th>Nama Unit</th>
					<th>Warna</th>
					<th>No. Polisi</th>
					<th>Jatuh Tempo</th>
				</thead>
				<tbody>
					@php
					$nopja = 1;
					@endphp
					@foreach($pajakarmada as $row)
					@php
					$newnopja = $nopja++;
					@endphp
					<tr>
						<td>{{$newnopja}}</td>
						<td>{{$row->nama}}</td>
						<td>{{$row->warna}}</td>
						<td>{{$row->nopol}}</td>
						<td>{{$row->tgl_kadaluarsa}}</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="5">
							<a href="{{url('/armada')}}" class="btn btn-success btn-block"><i class="fa fa-money"></i> Bayar Pajak Unit</a>
						</td>
					</tr>
				</tfoot>
			</table>
				</div>
			</section>
	            </div>
	            @endif
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
	                       
	                    </div><!--.box-typical-body-->
	                </section><!--.box-typical-dashboard-->
	                
	            </div><!--.col-->
	        </div>
	    </div><!--.container-fluid-->
	</div>
@endsection

@section('js')
<script src="{{asset('assets/js/lib/d3/d3.min.js')}}"></script>
<script src="{{asset('assets/js/lib/charts-c3js/c3.min.js')}}"></script>

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
				$jumlah = DB::table('resi_pengiriman')->where([['tgl',$hasil],['total_biaya','>',0]])->count();
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