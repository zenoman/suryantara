@extends('layout.masteradmin')
@section('header')
@foreach($webinfo as $info)
<title>{{$info->namaweb}}</title>
<link href="{{asset('img/setting/'.$info->icon)}}" rel="icon" type="image/png">
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
							<h2>List Pengiriman</h2>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					@if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                    @endif
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>No.Resi</th>
							<th>Tanggal</th>
							<th>Jalur</th>
							<th>Isi Paket</th>
							<th>Tujuan</th>
							<th>Pengirim</th>
							<th>Admin</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $i = 1;?>
                            @foreach($datakirim as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>
                            	<span class="label label-danger">{{$row->no_resi}}
                            	</span>
                            </td>
                            <td>{{$row->tgl}}</td>
                            <td>{{$row->pengiriman_via}}</td>
                            <td>{{$row->nama_barang}}</td>
                            <td>{{$row->kota_asal}} - {{$row->kode_tujuan}}
                            </td>
                            <td>{{$row->nama_pengirim}}</td>
                            <td>{{$row->username}}</td>
                            
						</tr>
						@endforeach
						</tbody>
						<tfoot>
						<tr>
							<th>No</th>
							<th>No.Resi</th>
							<th>Tanggal</th>
							<th>Jalur</th>
							<th>Isi Paket</th>
							<th>Tujuan</th>
							<th>Pengirim</th>
							<th>Admin</th>
						</tr>
						</tfoot>
					</table>
					{{ $datakirim->links() }}
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
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