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
							<h2>Edit Admin</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
						<form action="{{ url('admin/'.$datadmin->id) }}" role="form" method="POST">

				
@if(Session::get('level') == 'programer')
<div class="form-group row">
						<label class="col-sm-2 form-control-label">Kode Admin</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="kode" value="{{$datadmin->kode}}">
								<span class="help-block">*<b>pastikan</b> kode Kode admin <b>tidak sama</b> dengan kode admin yang lain </span></p>
						@if($errors->has('kode'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('kode')}}
                                         </div>
                                        @endif
						</div>
@else
				<div class="form-group row">
						<label class="col-sm-2 form-control-label">Kode Admin</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" disabled id="inputPassword" placeholder="Text" name="kode" value="{{$datadmin->kode}}"></p>
						</div>
					</div>
@endif
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="nama" name="nama" value="{{$datadmin->nama}}"></p>
						@if($errors->has('nama'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('nama')}}
                                         </div>
                                        @endif
						</div>
					</div>
				<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Username</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" pattern="[a-zA-Z0-9]+" id="inputPassword" placeholder="Text" name="username" value="{{$datadmin->username}}"></p>
							<span class="help-block">*Usernama Pengguna <b>harus</b> huruf dan angka</span>
						@if($errors->has('username'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('username')}}
                                         </div>
                                        @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Email</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="email" name="email" value="{{$datadmin->email}}"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="telp" name="telp" required onkeypress="return isNumberKey(event)" value="{{$datadmin->telp}}"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Alamat" name="alamat" value="{{$datadmin->alamat}}"></p>
						@if($errors->has('alamat'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('alamat')}}
                                         </div>
                                        @endif
						</div>
					</div>
					@if(Session::get('level') == 'programer')
					<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label  semibold">Level admin</label>
						<div class="col-sm-10">
							<select id="exampleSelect" name="level" class="form-control">
								<option value="{{$datadmin->level}}">{{$datadmin->level}}</option>
								<option>Select</option>
								<option value="superadmin">Superadmin</option>
								<option value="admin">Admin</option>
							</select>
						</div>
					</div>
					@endif
{{csrf_field()}}
				<input type="hidden" name="_method" value="PUT">
							<small class="text-muted">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								@if(Session::get('id') == $datadmin->id)
								<a href="{{url('admin/'.$row->id.'/changepas')}} " class="btn btn-warning btn-sm">
                                        <i class="fa fa-key"></i> Ganti Password</a>
								@endif
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
								
							</small>
				</form>
			</div>
</div>
</div>
        @endsection