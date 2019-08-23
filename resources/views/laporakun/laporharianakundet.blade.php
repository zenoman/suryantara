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
							<h2>Laporan @foreach($kat as $row){{$row->nama}}@endforeach tgl {{$tgl}} Sampai {{$tgl0}}</h2>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>No Resi</th>
							<th>Admin</th>
							<th>Kategori</th>
							<th>tgl</th>
							<th>Sub Total</th>
						</tr>
						</thead>
						<tbody>
						<?php $i = 1;?>
						<?php $j = 0;?>						
						@foreach($data as $row)
                            <?php $no = $i++;?>
                            <?php $n = $j++;?>
						{{-- @foreach($totsurat[$n] as $ros) --}}
                        <tr>
							<td align="center">{{$no}}</td>
							<td align="center">{{$row->no_resi}}</td>
							<td align="center">{{$row->admin}}</td>
							<td align="center">{{$row->nama}}</td>
							<td align="center">{{$row->tgl}}</td>
							<td align="center">{{number_format($row->total_biaya)}}</td>
							<td align="center" class="tdtot">{{$row->total_biaya}}</td>
                        </tr>
						{{-- @endforeach --}}
						@endforeach
						</tbody>											
					</table>
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
					<!-- <a href="{{url('/export_laporakun/'.$kat.'/'.$tgl.'/'.$tgl0.'')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan</a> -->
					<a href="{{url('/printlapoakundet/'.$katn.'/'.$tgl.'/'.$tgl0.'')}}"  class="btn btn-primary">
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
			for(var i=1;i<table.rows.length;i++){
				// sumval=sumval+parseInt(table.rows[i].cells[5].innerHTML);
				sumval=sumval+parseInt(table.rows[i].cells[6].innerHTML);
			}
			document.getElementById('toata').innerHTML=numberWithCommas(sumval);
			
		</script>
	@endsection