@extends('layout.masteradminnew')

@section('header')
	@foreach($title as $row)
		<title>{{$row->namaweb}}</title>
		<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
	@endforeach
@endsection

@section('content')
<script type="text/javascript">
    function isNumberKey(evt){
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
				@foreach($datadm as $datadmin)
					<form action="{{url('/editprofile/editdata')}}" role="form" method="POST">
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">
							Kode Admin
						</label>
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
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">
							Username
						</label>
						<div class="col-sm-10">
							<input type="hidden" name="idadmin" value="{{$datadmin->id}}">
							<p class="form-control-static">
								<input 
								type="text" 
								class="form-control"
								name="username" 
								value="{{$datadmin->username}}"
								required>
								<span class="help-block">
									*Usernama Pengguna <b>harus</b> huruf dan angka
								</span>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">
							Email
						</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input
								type="text" 
								class="form-control"
								name="email" 
								value="{{$datadmin->email}}" 
								required>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">
							No.telp
						</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input 
								type="text" 
								class="form-control"
								name="telp" 
								required 
								onkeypress="return isNumberKey(event)" 
								value="{{$datadmin->telp}}">
							</p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">
							Alamat
						</label>
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
						</div>
					</div>
					{{csrf_field()}}
					<small class="text-muted text-right">
						<input 
						class="btn btn-primary" 
						type="submit" 
						name="submit" 
						value="simpan">
						
						<a href="{{url('/editprofile/'.$datadmin->id.'/editpassword')}}" class="btn btn-warning">Ganti Password</a>
						<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
					</small>
				</form>
				@endforeach
			</div>
</div>
</div>
        @endsection