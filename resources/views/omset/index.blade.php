@extends('layout.masteradminnew')


@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection


@section('css')
<link href="{{asset('assets/css/lib/charts-c3js/c3.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{asset('assets/css/lib/datatables-net/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/lib/jqueryui/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/pages/widgets.min.css')}}">
@endsection


@section('content')
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Omset Cabang</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="row">
				@foreach ($cab as $item)
					<div class="col-xl-4 dashboard-col">
						<div class="card">
							<div class="card-header">
								{{$item->nama}}
							</div>
							<div class="card-body">
								@php
									$tglawal=date('Y-m-01');
									$tglakhir=date('Y-m-t');
									// dd($tglakhir);
									$rlunas=DB::table('resi_pengiriman')
											->select(DB::raw('sum(total_bayar) as totresi'))  
											->whereBetween('tgl',[$tglawal,$tglakhir])
											->whereNotNull('tgl_lunas')
											->where('duplikat','!=','Y')
											->where('id_cabang',$item->id)
											->first();
									$penresi=$rlunas->totresi;
									$pires=DB::table('resi_pengiriman')
											->select(DB::raw('sum(total_bayar) as totresi,sum(total_biaya) as totsemua'))   
											->whereBetween('tgl',[$tglawal,$tglakhir])
											->whereNull('tgl_lunas')
											->where('duplikat','!=','Y')
											->where('id_cabang',$item->id)
											->first();
											$tpr=$pires->totresi;
        									$tps=$pires->totsemua;
											$piuresi=$tps-$tpr;		
									$sj=DB::table('surat_jalan')
										->select(DB::raw('sum(biaya) as tbiaya'))
										->where('cabang','N')
										->where('id_cabang',$item->id)
										->whereBetween('tgl',[$tglawal,$tglakhir])
										->first();							
									$pum=Db::table('pengeluaran_lain')
										->where('id_cabang',$item->id)
										->select(DB::raw('sum(jumlah) as tpng'))
										->whereBetween('tgl',[$tglawal,$tglakhir])
										->first();							
								@endphp								
								<div class="card-legend-tbl">									
									<table class="table table-responsive">
										<tr class="bg-warning">
											<td><b>Total Omset</b></td>
											@php
												$tot=$penresi+$tpr-$sj->tbiaya-$pum->tpng;
											@endphp
											<td>Rp. {{number_format($tot)}}</td>
										</tr>
									</table>
									<table  class="table table-responsive">
										<tr>
											<td><b>Resi Lunas</b></td>
											<td>Rp. {{number_format($penresi)}}</td>
										</tr>
										<tr>
											<td><b>Cicilan Resi</b></td>
											<td>Rp. {{number_format($tpr)}}</td>
										</tr>
										<tr>
											<td><b>Tagihan Resi </b></td>
											<td>Rp. {{number_format($piuresi)}}</td>
										</tr>
										<tr>
											<td><b>Pengeluaran Surat Jalan </b></td>
											<td>Rp. {{number_format($sj->tbiaya)}}</td>
										</tr>
										<tr>
											<td><b>Pengeluaran Umum </b></td>
											<td>Rp. {{number_format($pum->tpng)}}</td>
										</tr>
									</table>									
									@if ($item->id != '1')										
										<table class="table table-responsive">
											<tr class="bg-primary">
												<td style="color:#fff" colspan="2" align="center">Transfer Ke Pusat</td>
											</tr>
											@php
												$tf=DB::table('transfer')
													->whereBetween('tgl',[$tglawal,$tglakhir])
													->where('id_cabang',$item->id)
													->get();
												$tottf=DB::table('transfer')
													->select(DB::raw('sum(nominal) as ttf'))
													->whereBetween('tgl',[$tglawal,$tglakhir])
													->where('id_cabang',$item->id)
													->first();
												$hut=$tottf->ttf-$tot;

											@endphp
											@foreach ($tf as $tff)
												<tr>
													<td>Yang Telah Di TF</td>
													<td>Rp. {{number_format($tff->nominal)}}</td>
												</tr>
											@endforeach											
											<tr>
												<td>Jumlah Yang Di Transfer</td>
												<td>Rp. {{number_format($tottf->ttf)}}</td>
											</tr>
											<tr>
												<td>Hutang Ke Pusat</td>
												<td>Rp. {{number_format($hut)}}</td>
											</tr>
											<tr>														
											</tr>
										</table>											
									@endif																		
								</div>
							</div>	
							<div class="card-body">
								<div id="scatter-plot-chart"></div>
							</div>						
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	@endsection
	@section('js')
			<script src="{{asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>	
			<script src="{{asset('assets/js/lib/d3/d3.min.js')}}"></script>
			<script src="{{asset('assets/js/lib/charts-c3js/c3.min.js')}}"></script>

	<script>
		$(function() {
			$('#example').DataTable({
            responsive: true,
            "paging":false
        });
		});
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
