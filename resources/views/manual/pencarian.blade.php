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
                    <a href="{{url('Manual')}}" class="btn btn-danger">Kembali</a>
					
                    <br><br>
					<form action="{{url('/Manual/hapuspilihan')}}" method="post">
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Fakur</th>
							<th>Aksi</th>
							<th><i class="font-icon font-icon-ok"></i></th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>Fakur</th>
							<th>Aksi</th>
							<th><i class="font-icon font-icon-ok"></i></th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($manual as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->faktur}}</td>
                            <td>
                                        <form action="{{url('karyawan/delete') }}"  method="post">
                            	<a href="{{url('karyawan/'.$row->id.'/edit') }}" class="btn btn-rimary btn-sm">
                                        <i class="fa fa-pencil"></i> Edit Data</a>
                                        	{{csrf_field()}}
                                        	<input type="hidden" name="aid" value="{{$row->id}}">
                                <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm">
                                        <i class="fa fa-remove"></i>Hapus</button>
                    					</form>
                            </td>
                            <td align="center">&nbsp;&nbsp;&nbsp;<input name="pilihid[]" type="checkbox"  id="checkbox[]" value="{{$row->id}}"  ></td>
						</tr>
						@endforeach
						</tbody>
						<tr>
							<th colspan="3"></th>
							<th>
<input onclick="return confirm('Hapus Data Terpilih ?')" type="submit" name="submit" class="btn btn-block btn-danger" value="hapus pilihan">
							</th>
						</tr>
					</table>
					{{csrf_field()}}
                        </form>
					 
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