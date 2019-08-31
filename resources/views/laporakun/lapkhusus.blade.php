@extends('layout.masteradminnew')


@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection


@section('css')
<link rel="stylesheet" href="{{asset('assets/css/lib/datatables-net/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/datatables-net.min.css')}}">
@endsection

@section('content')
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Laporan {{$pil}} tgl {{$tgl}} Sampai {{$tgl0}}</h2>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
				@if($kh=="sa")
				<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Pemegang</th>
							<th>Telp</th>
							<th>tgl</th>
							<th>Status</th>		
						</tr>
						</thead>
						<tbody>
						<?php $i = 1;?>
						<?php $j = 0;?>						
						@foreach($data as $row)
                            <?php $no = $i++;?>
                            <?php $n = $j++;?>
                        <tr>
							<td align="center">{{$no}}</td>
							<td align="center">{{$row->kode}}</td>
							<td align="center">{{$row->pemegang}}</td>
							<td align="center">{{$row->telp}}</td>							
							<td align="center">{{$row->tgl}}</td>
							<td align="center">
								@if ($row->status=="S")
									<p>Sampai</p>
								@else
									<p>Belum</p>
								@endif
							</td>							
                        </tr>
						@endforeach
						</tbody>										

					</table>
				@elseif($kh=="pajak")					
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Bulan</th>
							<th>Tahun</th>
							<th>Keterangan</th>
							<th>Total</th>	
						</tr>
						</thead>
						<tbody>
						<?php $i = 1;?>
						<?php $j = 0;?>						
						@foreach($data as $row)
                            <?php $no = $i++;?>
                            <?php $n = $j++;?>
                        <tr>
							<td align="center">{{$no}}</td>
							<td align="center">{{$row->bulan}}</td>
							<td align="center">{{$row->tahun}}</td>
							<td align="center">{{$row->nama_pajak}}</td>							
							<td align="center">Rp. {{number_format($row->total)}}</td>
							<td align="center" class="tdtot">{{$row->total}}</td>					
                        </tr>
						@endforeach
						</tbody>										

					</table>
				@else
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>No Resi</th>
							<th>Admin</th>
							<th>Tujuan</th>
							<th>tgl</th>
							<th>Berat</th>							
							<th>Sub Total</th>
						</tr>
						</thead>
						<tbody>
						<?php $i = 1;?>
						<?php $j = 0;?>						
						@foreach($data as $row)
                            <?php $no = $i++;?>
                            <?php $n = $j++;?>
                        <tr>
							<td align="center">{{$no}}</td>
							<td align="center">{{$row->kode}}</td>
							<td align="center">{{$row->admin}}</td>
							<td align="center">{{$row->tujuan}}</td>							
							<td align="center">{{$row->tgl}}</td>
							<td align="center">{{$row->totalkg}}</td>
							<td align="center">Rp. {{number_format($row->totalcash)}}</td>
							<td align="center" class="tdtot">{{$row->totalcash}}</td>
                        </tr>
						@endforeach
						</tbody>										

					</table>
					@endif
				</div>
			</section>
			<section class="card">
				<div class="card-body">
					<div class="col-md-12 col-lg-12 col-sm-12">
						<h2><b>Total Rp. <span id="toata"></span></b></h2>
					</div>	
				</div>
				<div class="card-block">							
					<div class="pull-right">
					{{-- <a href="{{url('/export_laporakun/'.$pil.'/'.$tgl.'/'.$tgl0.'')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan</a> --}}
					<a href="{{url('/printlapoakundet/0/'.$kh.'/'.$tgl.'/'.$tgl0.'')}}"  class="btn btn-primary">
					<i class="fa fa-print"></i>Cetak Data</a>
							&nbsp;&nbsp;
							<button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right">
								Kembali
							</button>
						
							
					</div>
				</div>
			</section>	
		</div>
	</div>	
	@endsection
		@section('js')
		<script src="{{asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>
		<script>
			$(function() {
				$('#example').DataTable({
				responsive: true,
				"paging":false
			});
			});
			$('document').ready(function(){
				$('.tdtot').hide();
			});
			// Call Sum
			function numberWithCommas(x) {
			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}
	
			var table=document.getElementById('example'),sumval=0;
			var pil= "{{$kh}}";
			for(var i=1;i<table.rows.length;i++){
				// sumval=sumval+parseInt(table.rows[i].cells[5].innerHTML);
				if(pil=="pajak"){
					sumval=sumval+parseInt(table.rows[i].cells[5].innerHTML);
				}else if(pil=="sa"){
					sumval=0;
				}
				else{
					sumval=sumval+parseInt(table.rows[i].cells[7].innerHTML);
				}
			}
			document.getElementById('toata').innerHTML=numberWithCommas(sumval);
			
		</script>
	@endsection