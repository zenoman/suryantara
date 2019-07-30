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
							<h2>Edit Jabatan</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">

						<form action="{{ url('jabatan/'.$jabat->id) }}" role="form" method="POST">

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Jabatan</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword"  name="jabatan" value="{{$jabat->jabatan}}"></p>
						@if($errors->has('jabatan'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('jabatan')}}
                                         </div>
                                        @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Gaji Pokok</label>
						<div class="col-sm-10">
							<div class="input-group">
								<div class="input-group-addon">
									Rp.
								</div>
								<input type="text" class="form-control" id="inputPassword" name="gaji_pokok" required onkeypress="return isNumberKey(event)" placeholder="Misal :Rp 23000" value="{{$jabat->gaji_pokok}}">
							</div>
							@if($errors->has('gaji_pokok'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('gaji_pokok')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Uang Makan</label>
						<div class="col-sm-10">
							<div class="input-group">
								<div class="input-group-addon">
									Rp.
								</div>
								<input type="text" class="form-control" id="inputPassword" name="uang_makan" required onkeypress="return isNumberKey(event)" placeholder="Misal :Rp 23000" value="{{$jabat->uang_makan}}">
							</div>
							@if($errors->has('uang_makan'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('uang_makan')}}
                                         </div>
                                       @endif
						</div>
					</div>
						<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label  semibold">Jabatan Cabang</label>
						<div class="col-sm-10">
							<select id="exampleSelect" name="cabang" class="form-control">
								@foreach($cabang as $row)
								<option value="{{$row->id}}" @if($jabat->id_cabang==$row->id) selected @endif>{{$row->nama}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label  semibold">Branch Manager</label>
						<div class="col-sm-10">
							<select id="exampleSelect" name="bm" class="form-control">
								<option value="0" @if($jabat->status=='0') selected @endif>Tidak</option>
								<option value="1" @if($jabat->status=='1') selected @endif>Ya</option>
							</select>
							<p class="text-muted">Jika dipilih 'Ya' maka jabatan ini akan mendapat tambahan gaji 1% dari omset cabang seperti Branch Manager</p>
						</div>
					</div>
{{csrf_field()}}
				<input type="hidden" name="_method" value="PUT">
							<small class="text-muted text-right">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
								
							</small>
				</form>
			</div>
</div>
</div>
        @endsection