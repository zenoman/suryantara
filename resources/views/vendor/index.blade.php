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
							<h2>Data Vendor</h2>
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
                    @if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
					<a href="{{url('vendor/create')}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Tambah Data</a>
					<a href="{{url('vendor/importexcel')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Import Excel</a>
					@endif
					<button class="btn btn-info" data-toggle="modal" data-target="#searchModal">
                                        <i class="fa fa-search"></i> Cari Data</button>
                                <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Cari Data Spesifik Dari Semua Data</h4>
                                        </div>
                                        

                                        <div class="modal-body">
                                           <form method="get" action="{{url('vendor/cari')}}">
                                            <div class="form-group">
                                                <input type="text" name="cari" class="form-control" placeholder="cari berdasarkan nama Vendor dan Id vendor" required>
                                            </div>
                                           {{csrf_field()}}
                                            <input type="submit" class="btn btn-info" value="Cari Data">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            
                                            </form>
                                        </div>
                                 
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                    <br><br>
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Id Vendor</th>
							<th>Vendor</th>
							<th>Telp</th>
							<th>Alamat</th>
							<th>Vendor Cabang</th>
							@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
							<th class="text-center">Aksi</th>
							@endif
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>Id Vendor</th>
							<th>Vendor</th>
							<th>Telp</th>
							<th>Alamat</th>
							<th>Vendor Cabang</th>
							@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
							<th class="text-center">Aksi</th>
							@endif
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($vendor as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->idvendor}}</td>
                            <td>{{$row->vendor}}</td>
                            <td>{{$row->telp}}</td>
                            <td>{{$row->alamat}}</td>
                            <td>{{$row->namacabang}}</td>
                            @if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
                            <td class="text-center">
<form action="{{url('/vendor/delete')}}"  method="post">
<a href="{{url('/vendor/'.$row->id.'/edit')}}" class="btn btn-warning btn-sm">Edit</a>
 
                                        {{csrf_field()}}
                                        	<input type="hidden" name="aid" value="{{$row->id}}">
<button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm">Hapus</button>
                    					</form>
                    				</td>
                    				@endif
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