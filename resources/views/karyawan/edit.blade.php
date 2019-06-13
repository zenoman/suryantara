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
							<h2>Edit Karyawan</h2>
						</div>
					</div>
				</div> 
			</header>
			<div class="box-typical box-typical-padding">
@foreach($datKaryawan as $ro)
						<form action="{{ url('karyawan/'.$ro->id) }}" role="form" method="POST">

				
	<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Id Karyawan</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input type="text" class="form-control" name ="kodess" id="inputPassword" placeholder="Id karyawan"  value="{{$ro->kode}}">
						</div>
	</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="nama" name="nama" value="{{$ro->nama}}"></p>
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
								@foreach($jabatan as $row)
								<option value="{{$row->id}}" @if($row->id==$ro->id_jabatan)selected @endif>{{$row->jabatan}}</option>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="telp" name="telp" required onkeypress="return isNumberKey(event)" value="{{$ro->telp}}"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Alamat" name="alamat" value="{{$ro->alamat}}"></p>
						@if($errors->has('alamat'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('alamat')}}
                                         </div>
                                        @endif
						</div>
					</div>
{{csrf_field()}}
				<input type="hidden" name="_method" value="PUT">
							<small class="text-muted">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
								
							</small>
							@endforeach
				</form>
			</div>
</div>
</div>
        @endsection