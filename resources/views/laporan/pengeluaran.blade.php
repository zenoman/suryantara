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
							<h2>Laporan Pengeluaran {{$bulanya}}</h2>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					@if($vendor!='semua')
						<h4>vendor : {{$vendor}}</h4>
					@endif
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>tanggal</th>
								@if($vendor=='semua')
									<th>vendor</th>
								@endif
							<th>admin</th>
							<th>Subtotal</th>
						</tr>
						</thead>
						<tfoot>
						<tr> 
							<th>No</th>
							<th>Kode</th>
							<th>tanggal</th>
								@if($vendor=='semua')
									<th>vendor</th>
								@endif
							<th>admin</th>
							<th>Subtotal</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->kode}}</td>
                            <td>{{$row->tgl}}</td>
                           
                            	@if($vendor=='semua')
								  <td>{{$row->tujuan}}</td>
                            	@endif
                            <td>{{$row->username}}</td>
							<td>{{"Rp ".number_format($row->biaya,0,',','.')}}</td>
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
						
							<button type="button" class="btn btn-primary" onclick="cetak()">
								cetak
							</button>	
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
	

		<div id="hidden_div" style="display: none;">
		<table style="width: 100%">
			<tr>
				<td colspan="2" align="center">
					<b>
						@if($vendor=='semua')
						Laporan Pengeluaran Bulan {{$bulanya}}
						@else
						Laporan Pengeluaran {{$vendor}} Bulan {{$bulanya}}
						@endif
						
					</b>
				</td>
			</tr>
			<tr>
				<td>
					Tanggal Cetak : {{date('d-m-Y')}}	
				</td>
				<td align="right">
					Pencetak : {{Session::get('username')}}
				</td>

			</tr>
		</table>
		<table border="1" style="width: 100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>tanggal</th>
								@if($vendor=='semua')
									<th>vendor</th>
								@endif
							<th>admin</th>
							<th>Subtotal</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td align="center">{{$no}}</td>
                            <td align="center">{{$row->kode}}</td>
                            <td align="center">{{$row->tgl}}</td>
                            	@if($vendor=='semua')
								 <td align="center">{{$row->tujuan}}</td>
                            	@endif
                            <td align="center">{{$row->username}}</td>
                           
							<td align="center">{{"Rp ".number_format($row->biaya,0,',','.')}}</td>
                          
						</tr>
						@endforeach
						
						</tbody>
					</table>
					<p>Total : <b>{{"Rp. ".number_format($ttl->totalnya,0,',','.')}}</b></p>
			</div>
	@endsection
		@section('js')
	<script src="{{asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>
	<script>
		$(function() {
			$('#example').DataTable({
            responsive: true
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