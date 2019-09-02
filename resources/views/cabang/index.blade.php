@extends('layout.masteradminnew')


@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection



@section('content')
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Data Cabang</h2>
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
                    @if(Session::get('level') == 'programer')
					<a href="{{url('cabang/create')}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Tambah Data</a>
					<br><br>
					@endif
					
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Kode Resi</th>
							<th>Alamat</th>
							<th>Kota</th>
							<th class="text-center">Aksi</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Kode Resi</th>
							<th>Alamat</th>
							<th>Kota</th>
							<th class="text-center">Aksi</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($datacabang as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->nama}}</td>
                            <td>{{$row->koderesi}}</td>
                            <td>{{$row->alamat}}</td>
                            <td>{{$row->kota}}</td>
                            <td class="text-center">
                              <form action="{{ url('/cabang/'.$row->id)}}"  method="post">                            	
                            	<a href="{{ url('cabang/'.$row->id.'') }}" class="btn btn-rimary btn-sm">Edit</a>
                                        	{{csrf_field()}}
                                        	
                                        	<input type="hidden" name="_method" value="delete">
                                        	@if(Session::get('level') == 'programer')
                                <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm">Hapus</button>
                                @endif
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
