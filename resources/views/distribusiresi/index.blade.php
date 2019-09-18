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
							<h2>Data Ditribusi Resi</h2>
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
					<a href="{{url('distribusiresi/create')}}" class="btn btn-primary">Tambah Data</a>
					<a href="{{url('distribusiresi/exsportexcel')}}" class="btn btn-success"><i class="fa fa-file-excel"></i> Import Excel</a>
                    <br><br>
					<table id="example" class="display table table-striped table-bordered" width="100%">
						<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">No Resi</th>
							<th class="text-center">Cabang</th>
							<th class="text-center">Pembuat</th>
							<th class="text-center">Aksi</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">No Resi</th>
							<th class="text-center">Cabang</th>
							<th class="text-center">Pembuat</th>
							<th class="text-center">Aksi</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td class="text-center">{{$no}}</td>
                            <td class="text-center">{{$row->no_resi}}</td>
                            <td class="text-center">{{$row->nama}}</td>
                            <td class="text-center">{{$row->pembuat}}</td>
                            <td class="text-center">
								<form action="{{url('/distribusiresi/'.$row->id)}}" method="post">
									
 									{{csrf_field()}}
                                    <input type="hidden" name="_method" value="delete">
									<button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm">Hapus</button>
                    			</form>
                    		</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>
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