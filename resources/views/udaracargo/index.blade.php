@extends('layout.master')
@section('tabel')
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Data Udara Cargo</h2>
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
					<a href="{{url('udrkargo/create')}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Tambah Data</a>
                    <br><br>
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode Udara</th>
							<th>Tarif</th>
							<th>Persentase</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>Kode Udara</th>
							<th>Tarif</th>
							<th>Persentase</th>
							<th>Aksi</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($udr_kargo as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->kode_udara}}</td>
                            <td>{{$row->tarif}}</td>
                            <td>{{$row->persentase}}</td>
                            <td><a href="udrkargo/{{$row->id}}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil"></i> Edit</a>
                                <a href="udrkargo/{{$row->id}}/delete" class="btn btn-danger btn-sm">
                                        <i class="fa fa-remove" onclick="return confirm('Hapus Data ?')"></i>Hapus</a>
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