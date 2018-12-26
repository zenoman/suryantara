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
							<h2>Laporan Pemasukan</h2>
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
							<th>No resi</th>
							<th>tanggal</th>
							<th>jalur</th>
							<!-- <th>Aksi</th> -->
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>No resi</th>
							<th>tanggal</th>
							<th>jalur</th>
							<!-- <th>Aksi</th> -->
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
                            <td>{{$row->pengiriman_via}}</td>
                            <!-- <td>
                            	<a href="{{url('admin/'.$row->id.'/changepas')}} " class="btn btn-warning btn-sm">
                                        <i class="fa fa-key"></i> Ganti Password</a>
                            	<a href="admin/{{$row->id}}" class="btn btn-rimary btn-sm">
                                        <i class="fa fa-pencil"></i> Edit Data</a>
                                <a  onclick="return confirm('Hapus Data ?')" href="admin/{{$row->id}}/delete" class="btn btn-danger btn-sm">
                                        <i class="fa fa-remove"></i>Hapus</a>
                            </td> -->
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
	<script>
		$(function() {
			$('#example').DataTable({
            responsive: true,
            "paging":false
        });
		});
	</script>
	@endsection