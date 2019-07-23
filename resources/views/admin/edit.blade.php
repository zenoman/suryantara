@extends('layout.masteradminnew')

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

				

				<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Kode Admin</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" disabled id="inputPassword" placeholder="Text" name="kode" value="{{$datadmin->kode}}"></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input 
								type="text" 
								class="form-control"
								name="nama" 
								value="{{$datadmin->nama}}"
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
						<label class="col-sm-2 form-control-label semibold">Username</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input 
								type="text" 
								class="form-control"
								name="username" 
								value="{{$datadmin->username}}"
								required>

								<span class="help-block">*Usernama Pengguna <b>harus</b> huruf dan angka</span>
							</p>
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
							<p class="form-control-static">
								<input
								type="text" 
								class="form-control"
								name="email" 
								value="{{$datadmin->email}}" required>
							</p>
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
							<p class="form-control-static">
								<input 
								type="text" 
								class="form-control"
								name="telp" 
								required 
								onkeypress="return isNumberKey(event)" 
								value="{{$datadmin->telp}}"></p>
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
							<p class="form-control-static">
								<input 
								type="text" 
								class="form-control" 
								id="inputPassword" 
								placeholder="Alamat" 
								name="alamat" 
								value="{{$datadmin->alamat}}"
								required>
							</p>
						@if($errors->has('alamat'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('alamat')}}
                                         </div>
                                        @endif
						</div>
					</div>
					@if(Session::get('level') !='admin')
					<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label semibold">Level admin</label>
						<div class="col-sm-10">
							<select id="exampleSelect" name="level" class="form-control">
								@if(Session::get('level') == 'programer')
								<option value="programer" @if($datadmin->level=='programer')selected @endif>Programer</option>
								@endif
								<option value="operasional_cabang" @if($datadmin->level=='operasional_cabang')selected @endif>Operasional Cabang</option>
								<option value="operasional" @if($datadmin->level=='operasional')selected @endif>Operasional</option>
							
								<option value="cs" @if($datadmin->level=='cs')selected @endif>Customer Service</option>
								<option value="admin_cabang" @if($datadmin->level=='admin_cabang')selected @endif>Admin Cabang</option>
								<option value="admin" @if($datadmin->level=='admin')selected @endif>Admin</option>
								<option value="superadmin" @if($datadmin->level=='superadmin')selected @endif>Superadmin</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label  semibold">Penempatan</label>
						<div class="col-sm-10">
							<select id="exampleSelect" name="cabang" class="form-control">
								@foreach($cabang as $cb)
								<option value="{{$cb->id}}" @if($datadmin->id_cabang==$cb->id)selected @endif>{{$cb->nama}}</option>
								@endforeach
							</select>
						</div>
					</div>
					@endif
					
{{csrf_field()}}
				<input type="hidden" name="_method" value="PUT">
							<small class="text-muted text-right">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								@if(Session::get('id') == $datadmin->id)
								<a href="{{url('admin/'.$datadmin->id.'/changepas')}} " class="btn btn-warning">
                                        <i class="fa fa-key"></i> Ganti Password</a>
								@endif
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
								
							</small>
				</form>
			</div>
</div>
</div>
        @endsection