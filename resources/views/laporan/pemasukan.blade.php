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
							<h2>Laporan Pemasukan {{$bulanya}}</h2>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					@if($jalur!='semua')
						<h4>Jalur : {{$jalur}}</h4>
					@endif
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>No resi</th>
							<th>tanggal</th>
							<th>Tujuan</th>
								@if($jalur=='semua')
									<th>jalur</th>
								@endif
							<th>pengirim</th>
							<th>penerima</th>
							<th>admin</th>
							<th>Subtotal</th>
						</tr>
						</thead>
						<tfoot>
						<tr> 
							<th>No</th>
							<th>No resi</th>
							<th>tanggal</th>
							<th>Tujuan</th>
								@if($jalur=='semua')
									<th>jalur</th>
								@endif
							<th>pengirim</th>
							<th>penerima</th>
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
                            <td>{{$row->no_resi}}</td>
                            <td>{{$row->tgl}}</td>
                            <td>{{$row->kota_asal}}-{{$row->kode_tujuan}}</td>
                            	@if($jalur=='semua')
								 <td>{{$row->pengiriman_via}}</td>
                            @endif
                            <td>{{$row->nama_pengirim}}</td>
                            <td>{{$row->nama_penerima}}</td>
							<td>{{$row->admin}}</td>
							<td>{{"Rp ".number_format($row->total_biaya,0,',','.')}}</td>
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
						@if($jalur=='semua')
						Laporan Pemasukan Bulan {{$bulanya}}
						@else
						Laporan Pemasukan {{$jalur}} Bulan {{$bulanya}}
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
							<th>No resi</th>
							<th>tanggal</th>
							<th>Tujuan</th>
								@if($jalur=='semua')
									<th>jalur</th>
								@endif
							<th>pengirim</th>
							<th>penerima</th>
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
                            <td align="center">{{$row->no_resi}}</td>
                            <td align="center">{{$row->tgl}}</td>
                            <td align="center">{{$row->kota_asal}}-{{$row->kode_tujuan}}</td>
                            	@if($jalur=='semua')
								 <td>{{$row->pengiriman_via}}</td>
                            @endif
                            <td align="center">{{$row->nama_pengirim}}</td>
                            <td align="center">{{$row->nama_penerima}}</td>
							<td align="center">{{$row->admin}}</td>
							<td align="center">{{"Rp ".number_format($row->total_biaya,0,',','.')}}</td>
                          
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