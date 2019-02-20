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
					@if($kategori!='semua')
						<h4>Kategori : {{$kategori}}</h4>
					@endif
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>tanggal</th>
							@if($kategori=='semua')
									<th>Kategori</th>
							@endif
							<th>Jumlah</th>
							<th>Pembuat</th>
							<th>Keterangan</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>tanggal</th>
							@if($kategori=='semua')
									<th>Kategori</th>
							@endif
							<th>Jumlah</th>
							<th>Pembuat</th>
							<th>Keterangan</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $nomer = 1;?>
                            @foreach($data as $row)
                        <tr>
							<td>{{$nomer++}}</td>
							<td>{{$row->tgl}}</td>
							@if($kategori=='semua')
							<td>{{$row->kategori}}</td>
							@endif
							<td>{{"Rp ".number_format($row->jumlah,0,',','.')}}</td>
							<td>
								{{$row->admin}}
							</td>
							<td>
								{{$row->keterangan}}
							</td>
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
						
						<a href="{{url('/export_laporan_pengeluaran_lain/'.$bulanya.'/'.$kategori.'')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan lain</a>
							&nbsp;&nbsp;
								<a href="{{url('/printpengeluaranlainya/'.$bulanya.'/'.$kategori.'')}}" target="_blank()" class="btn btn-primary">
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
