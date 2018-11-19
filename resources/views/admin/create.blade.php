@extends('layout.master')
@section('content')
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Input Tarif Darat</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">

				<form action="{{ url('admin') }}" role="form" method="POST">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Kode Admin</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input type="text" class="form-control" placeholder="Masukkan Kode Admin" name="kode">
							</p>
							 @if($errors->has('kode'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('kode')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="nama" placeholder="Masukan Nama"></p>
							@if($errors->has('nama'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('nama')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">username</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" placeholder="Masukkan Username"  name="username"></p>
							@if($errors->has('username'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('username')}}
                                         </div>
                                        @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Password</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="password" class="form-control" placeholder="Masukkan Password" name="password"></p>
							@if($errors->has('password'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('password')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Email</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="email" placeholder="Masukkan Email"></p>
							@if($errors->has('email'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('email')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">No.telp</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="telp" placeholder="Misal : 085**********"></p>
							@if($errors->has('telp'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('telp')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Alamat</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="alamat" placeholder="Masukkan Alamat"></p>
							@if($errors->has('alamat'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('alamat')}}
                                         </div>
                                       @endif
						</div>
					</div>

{{csrf_field()}}
							<small class="text-muted">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
							</small>
				</form>
			</div>
        @endsection
