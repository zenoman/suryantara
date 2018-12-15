@extends('layout.master')
@section('tabel')
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2 class = "page-header">Hasil Pencarian</h2>
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
                    <a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
					
                    <br><br>
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<a>List Data Admin</a>
						<thead>
						<tr>
							<th>No</th>
							<th>Kode Admin</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>kode Admin</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Aksi</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($datadmin as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->kode}}</td>
                            <td>{{$row->nama}}</td>
                            <td>{{$row->username}}</td>
                            <td>
                            	<a href="{{url('admin/'.$row->id.'/changepas')}} " class="btn btn-warning btn-sm">
                                        <i class="fa fa-key"></i> Ganti Password</a>
                            	<a href="admin/{{$row->id}}" class="btn btn-rimary btn-sm">
                                        <i class="fa fa-pencil"></i> Edit Data</a>
                                <a  onclick="return confirm('Hapus Data ?')" href="admin/{{$row->id}}/delete" class="btn btn-danger btn-sm">
                                        <i class="fa fa-remove"></i>Hapus</a>
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