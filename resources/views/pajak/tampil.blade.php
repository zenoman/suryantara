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
							<th>bulan</th>
							<th>tahun</th>
							<th class="text-right">Subtotal</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>bulan</th>
							<th>tahun</th>
							<th class="text-right">Subtotal</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->bulan}}</td>
                            <td>{{$row->tahun}}</td>
                            <td class="text-right">{{"Rp ".number_format($row->total,0,',','.')}}</td>
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