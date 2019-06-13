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
							<h2>Input Data Kategori Akutansi</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<form action="{{ url('kat_akut') }}" role="form" method="POST">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Kode Kategori</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input type="text" class="form-control" placeholder="Masukkan Kode Karyawan" name="kode" required>
								<p>
									@if($errors->has('kode'))
                            	<div class="alert alert-danger">
                            		{{ $errors->first('kode')}}
                            	</div>
                           @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama Kategori</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input 
								type="text" 
								class="form-control"
								name="nama" 
								placeholder="Masukan Nama Karyawan"
								required>
							</p>
							@if($errors->has('nama'))
                            	<div class="alert alert-danger">
                            		{{ $errors->first('nama')}}
                            	</div>
                           @endif
						</div>
					</div>
					<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label semibold">Status</label>
						<div class="col-sm-10">
							<select id="exampleSelect" name="status" class="form-control">
								<option selected disabled hidden>Pilih Status</option>
								<option value="pendapatan">Pendapatan</option>
								<option value="pengeluaran">Pengeluaran</option>
							</select>
						</div>
						@if($errors->has('status'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('status')}}
                                         </div>
                                       @endif
					</div>


{{csrf_field()}}
							<small class="text-muted">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
							</small>
				</form>
			</div>
			</div>
			</div>
        @endsection