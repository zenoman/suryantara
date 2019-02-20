@extends('layout.masteradmin')


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
							@if($tahunya=='semua')
							<h2>Laporan Pajak </h2>
							@else
							<h2>Laporan Pajak Tahun {{$tahunya}}</h2>
							@endif
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
							@if($tahunya=='semua')
								<th>bulan</th>
							@endif
							<th>tahun</th>
							<th>Subtotal</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							@if($tahunya=='semua')
								<th>bulan</th>
							@endif
							<th>tahun</th>
							<th>Subtotal</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            @if($tahunya=='semua')
                            <td>{{$row->bulan}}</td>
                            @endif
                            <td>{{$row->tahun}}</td>
                            <td>{{"Rp ".number_format($row->total,0,',','.')}}</td>
                        </tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>

	
			@foreach($total as $ttl)
			<section class="card">
				<div class="card-block">
					<h2>Total <b>{{"Rp ".number_format($ttl->totalnya,0,',','.')}}</b></h2>
					<div class="pull-right">
<!-- <a href="#" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan</a> -->
							&nbsp;&nbsp;
								<a href="{{url('/printpajak/'.$tahunya.'')}}" target="_blank()" class="btn btn-primary">
								<i class="fa fa-print"></i>
								Cetak Data
							</a>	
							&nbsp;&nbsp;
							<button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right">
								Kembali
							</button>
						
							
					</div>
				</div>
			</section>
	
			@endforeach
			
		</div>
	</div>
	@endsection
		@section('js')
	<script src="{{asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>
	<script>
		$(function() {
			$('#example').DataTable({
            responsive: true,
            "paging":true
        });
		});

		
	</script>
	@endsection
	@section('otherjs')
	<script>
		function cetak(){
		var divToPrint=document.getElementById('hidden_div');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print();window.close()">'+divToPrint.innerHTML+'</body></html>');
		newWin.document.close();
		}
	</script>
	@endsection