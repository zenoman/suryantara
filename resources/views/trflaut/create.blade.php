@extends('layout.masteradmin')

@section('header')
<title>Suryantara</title>
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
							<h2>Input Tarif Laut</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<form action="{{url('trflaut') }}" role="form" method="POST">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Kode</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Kode Tujuan" name="kode" ></p>
							 @if($errors->has('kode'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('kode')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Tujuan</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="tujuan" placeholder="Misal : Gresik" ></p>
							@if($errors->has('tujuan'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('tujuan')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Tarif</label>
						<div class="col-sm-10">
								<div class="input-group">
								<div class="input-group-addon">
									Rp.
								</div>
								<input type="text" class="form-control" id="inputPassword" name="tarif" required onkeypress="return isNumberKey(event)">
								
							</div>
							@if($errors->has('tarif'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('tarif')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Berat minimal</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="text" class="form-control" id="inputPassword" name="berat_minimal" required onkeypress="return isNumberKey(event)">
								<div class="input-group-addon">
									Kg
								</div>
							</div>
							@if($errors->has('berat_minimal'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('berat_minimal')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Estimasi</label>
						<div class="col-sm-10">
								<div class="input-group">
								<input type="text" class="form-control" id="inputPassword" name="estimasi" required onkeypress="return isNumberKey(event)">
								<div class="input-group-addon">
									Hari
								</div>
							</div>
							@if($errors->has('estimasi'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('estimasi')}}
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
