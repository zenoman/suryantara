@extends('layout.master')
@section('tabel')
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Data tarif Laut</h2>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					<a href="{{url('trflaut/create')}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Tambah Data</a>
                    <br><br>
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Tujuan</th>
							<th>Tarif</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>kode</th>
							<th>Tujuan</th>
							<th>Tarif</th>
							<th>Aksi</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($trflaut as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->kode}}</td>
                            <td>{{$row->tujuan}}</td>
                            <td>{{$row->tarif}}</td>
                            <td><a href="trflaut/{{$row->id}}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil"></i> Edit</a>
                                <a href="trflaut/{{$row->id}}/delete" class="btn btn-danger btn-sm">
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