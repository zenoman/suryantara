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
							<h2>Input Mitra</h2>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">

				<form action="{{url('mitra') }}" role="form" method="POST">
					
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama Mitra</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="nama" placeholder="Nama mitra" required></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Telp</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="telp" required onkeypress="return isNumberKey(event)" placeholder="Misal : 085**********"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Alamat</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat"></p>
							
						</div>
					</div>
					
						<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label  semibold">Mitra Cabang</label>
						<div class="col-sm-10">
							<select id="exampleSelect" name="idcabang" class="form-control">
								@foreach($cabang as $row)
								<option value="{{$row->id}}">{{$row->nama}}</option>
								@endforeach
							</select>
						</div>
					</div>

				{{csrf_field()}}
							<small class="text-muted text-right"><input class="btn btn-primary" type="submit" name="submit" value="simpan">
							<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
						</small>

				</form>
			</div>
	</div>
</div>
        @endsection
