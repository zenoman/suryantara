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
							<h2>Data Penyusutan</h2>
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
					<a href="{{url('nyusut/create')}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Tambah Data</a>
                    <br><br>
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Harga Perolehan</th>
							<th>Residu</th>
							<th>Umur Ekonomis perbln</th>
							<th>Umur Ekonomis perthn</th>
							<th>Penyusutan</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Harga Perolehan</th>
							<th>Residu</th>
							<th>Umur Ekonomis perbln</th>
							<th>Umur Ekonomis perthn</th>
							<th>Penyusutan</th>
							<th>Aksi</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($sut as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->nama}}</td>
                            <td>{{"Rp ". number_format($row->harga,0,',','.')}}</td>
                            <td>{{"Rp ". number_format($row->residu,0,',','.')}}</td>
                            <td>{{$row->umurbln}}</td>
                            <td>{{$row->umurthn}}</td>
                            <td>{{"Rp ". number_format($row->penyusutan,0,',','.')}}</td>
                            <td>
                              <form action="{{ url('/nyusut/delete')}}"  method="post">                            	
                            	<a href="{{ url('/nyusut/'.$row->id.'/edit') }}" class="btn btn-rimary btn-sm">
                                        <i class="fa fa-pencil"></i> Edit Data</a>
                                        	{{csrf_field()}}
                                        	
                                        	<input type="hidden" name="aid" value="{{$row->id}}">
                                <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm">
                                        <i class="fa fa-remove"></i>Hapus</button>
                    					</form>
                            </td>
						</tr>
						@endforeach
						</tbody>
					</table>
					 {{ $sut->links() }}
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