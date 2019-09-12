@extends('layout.masteradminnew')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection

@section('content')
@if(Session::get('level') == 'admin')
<script type="text/javascript">
    window.location.href = '{{url("/dashboard")}}';
</script>
@endif
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
								<input type="text" class="form-control" disabled placeholder="Masukkan Kode Admin" name="kode" value="{{$kode}}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="nama" placeholder="Masukan Nama Admin" required></p>
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
							<p class="form-control-static"><input type="text" class="form-control" pattern="[a-zA-Z0-9]+" placeholder="Masukkan Username Admin Minimal 5 Huruf"  name="username" required autocomplete="new-username">
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
							<p class="form-control-static"><input type="password" class="form-control" placeholder="Masukkan Password Admin Minimal 5 Huruf" name="password" required autocomplete="new-password"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="email" placeholder="Masukkan Email" required></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="alamat" placeholder="Masukkan Alamat" required></p>
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
								@foreach($role as $rls)
								<option value="{{$rls->id}}">{{$rls->level}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label  semibold">Penempatan</label>
						<div class="col-sm-10">
							<select id="exampleSelect" name="cabang" class="form-control">
								@foreach($cabang as $row)
								<option value="{{$row->id}}">{{$row->nama}}</option>
								@endforeach
							</select>
						</div>
					</div>


{{csrf_field()}}
							<small class="text-muted text-right">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
							</small>
				</form>
			</div>


			</div>
			</div>
        @endsection
