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
							<th>No.Resi</th>
							<th>Tanggal Bayar</th>
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
							<th>No.Resi</th>
							<th>Tanggal Bayar</th>
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
                            <td>{{$row->no_resi}}</td>
                            <td>{{$row->tgl_bayar}}</td>
                           
                            	@if($vendor=='semua')
								  <td>
								  	<?php
								  		$vendornya = explode('-',$row->tujuan);
								  	?>
								  	{{$vendornya[0]}}
								  </td>
                            	@endif
                            <td>{{$row->admin}}</td>
							<td>{{"Rp ".number_format($row->biaya_suratjalan,0,',','.')}}</td>
                        </tr>
						@endforeach
						</tbody>
					</table>
					{{ $data->links() }}
				</div>
			</section>

	
			@foreach($total as $ttl)
			<section class="card">
				<div class="card-block">
					<h2>Total <b>{{"Rp ".number_format($ttl->totalnya,0,',','.')}}</b></h2>
					<div class="pull-right">
<a href="{{url('/export_laporan_pengeluaran_vendor/'.$habu.'/'.$bulanya.'/'.$vendor.'')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan</a>
							&nbsp;&nbsp;
								<a href="{{url('/printlaporanpengeluaran/'.$habu.'/'.$bulanya.'/'.$vendor.'')}}" target="_blank()" class="btn btn-primary">
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
            "paging":false
        });
		});

		
	</script>
	@endsection
