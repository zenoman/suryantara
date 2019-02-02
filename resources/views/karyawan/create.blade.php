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
							<h2>Input Karyawan</h2>
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
				<form action="{{ url('karyawan') }}" role="form" method="POST">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Kode Karyawan</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input type="text" class="form-control" disabled placeholder="Masukkan Kode Karyawan" name="kode" value="{{$kode}}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="nama" placeholder="Masukan Nama Karyawan"></p>
							@if($errors->has('nama'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('nama')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label  semibold">Jabatan</label>
						<div class="col-sm-10">
							<select id="exampleSelect" name="jabatan" class="form-control">
								<option>Pilih Jabatan</option>
								@foreach($jabatan as $row)
								<option value="{{$row->id}}">{{$row->jabatan}}</option>
								@endforeach
							</select>
						</div>
						@if($errors->has('jabatan'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('jabatan')}}
                                         </div>
                                       @endif
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