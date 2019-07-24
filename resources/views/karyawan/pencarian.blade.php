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
							<h2 class = "page-header">Hasil Pencarian</h2>
							<h5>Hasil Pencarian "{{$cari}}"</h5>
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
                    <a href="{{url('karyawan')}}" class="btn btn-danger">Kembali</a>
					
                    <br><br>
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
					
						<thead>
						<tr>
							<th>No</th>
							<th>Id karyawan</th>
							<th>Nama</th>
							<th>Jabatan</th>
							<th>Telp</th>
							<th>Alamat</th>
							<th>Penempatan</th>
							<th class="text-center">Aksi</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>Id karyawan</th>
							<th>Nama</th>
							<th>Jabatan</th>
							<th>Telp</th>
							<th>Alamat</th>
							<th>Penempatan</th>
							<th class="text-center">Aksi</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($datKaryawan as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->kode}}</td>
                            <td>{{$row->nama}}</td>
                            <td>{{$row->jabatan}}</td>
                            <td>{{$row->telp}}</td>
                            <td>{{$row->alamat}}</td>
                            <td>{{$row->namacabang}}</td>
                            <td class="text-center">
                                        <form action="{{url('karyawan/delete') }}"  method="post">
                            	<a href="{{url('karyawan/'.$row->id.'/edit') }}" class="btn btn-rimary btn-sm">Edit Data</a>
                                        	{{csrf_field()}}
                                        	<input type="hidden" name="aid" value="{{$row->id}}">
                                <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm">Hapus</button>
                    					</form>
                            </td>
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
            "paging":true
        });
		});
	</script>
	@endsection