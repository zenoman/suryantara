@extends('layout.masteradmin')


@section('header')
<title>Suryantara</title>
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
							<h2>Laporan Pengiriman</h2>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					<!-- <a href="{{url('trfdarat/create')}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Tambah Data</a>
                    <br><br> -->
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Nama Barang</th>
							<th>via</th>
							<th>koata tujuan</th>
							<th>tanggal</th>
							<th>Pengirim</th>
							<th>Penerima</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>Nama Barang</th>
							<th>via</th>
							<th>koata tujuan</th>
							<th>tanggal</th>
							<th>pengirim</th>
							<th>Penerima</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->nama_barang}}</td>
                            <td>{{$row->pengiriman_via}}</td>
                            <td>{{$row->tujuan}}</td>
                            <td>{{$row->tgl}}</td>
                            <td>{{$row->nama_pengirim}}</td>
                            <td>{{$row->nama_penerima}}</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	@endsection


	@section('js')
	<script src="{{asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>
	@yield('js')
	<script>
		$(function() {
			$('#example').DataTable({
            responsive: true,
            "paging":true
        });
		});
	</script>
	@endsection