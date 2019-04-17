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
                            <td>
                            	@if($row->batal=='N')
                            	{{$row->no_resi}}
                            	@else
                            	<span class="text-danger">
                            		{{$row->no_resi}}
                            	</span>
                            	@endif
                            </td>
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
					{{ $data->links() }}
				</div>
			</section>

	
			@foreach($total as $ttl)
			<section class="card">
				<div class="card-block">
					<h2>Total <b>{{"Rp ".number_format($ttl->totalnya,0,',','.')}}</b></h2>
					<div class="pull-right">

<a href="{{url('/export_laporan_pemasukan/'.$habu.'/'.$bulanya.'/'.$jalur.'')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan</a>
							&nbsp;&nbsp;
<a href="{{url('/printpemasukan/'.$habu.'/'.$bulanya.'/'.$jalur.'')}}" target="_blank()" class="btn btn-primary">
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