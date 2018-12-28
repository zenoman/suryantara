@extends('layout.masteradmin')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection

@section('content')
<script type="text/javascript">
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</script>
<div class="page-content">
		<div class="container-fluid">
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Input Admin</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
					@if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                    @endif
				<form action="{{ url('admin') }}" role="form" method="POST">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Kode Admin</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input type="text" class="form-control" placeholder="Masukkan Kode Admin" name="kode">
							<span class="help-block">*<b>pastikan</b> kode Kode admin <b>tidak sama</b> dengan kode admin yang lain </span></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="nama" placeholder="Masukan Nama Admin"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" pattern="[a-zA-Z0-9]+" placeholder="Masukkan Username Admin Minimal 5 Huruf"  name="username">
							<span class="help-block">*Usernama Pengguna <b>harus</b> huruf dan angka</span>

							@if($errors->has('username'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('username')}}
                                         </div>
                                        @endif
						</div>
					</div>
					<p>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Password</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="password" class="form-control" placeholder="Masukkan Password Admin Minimal 5 Huru" name="password"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="telp" required onkeypress="return isNumberKey(event)" placeholder="Misal : 085**********"></p>
							
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
					<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label  semibold">Level admin</label>
						<div class="col-sm-10">
							<select id="exampleSelect" name="level" class="form-control">
								<option>Select</option>
								@if(Session::get('level') == 'programer')
								<option value="programer">Programer</option>
								@endif
								<option value="superadmin">Superadmin</option>
								<option value="admin">Admin</option>
							</select>
						</div>
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
