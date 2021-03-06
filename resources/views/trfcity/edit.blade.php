@extends('layout.masteradminnew')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection

@section('content')
<div class="page-content">
		<div class="container-fluid">
		<script type="text/javascript">
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</script>

<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Edit Tarif Darat</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				@foreach($trf_drt as $drt)
						<form action="{{ url('trfcity/'.$drt->id) }}" role="form" method="POST">

				<!--<h5 class="m-t-lg with-border">Vertical Inputs</h5>-->

				<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold	">Kode</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Kode Tujuan" name="kode" value="{{$drt->kode}}"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Misal : Gresik" name="tujuan" value="{{$drt->tujuan}}"></p>
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

							<input type="text" class="form-control" id="inputPassword"  name="tarif" required onkeypress="return isNumberKey(event)" value="{{$drt->tarif}}">
							
							</div>
						@if($errors->has('tarif'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('tarif')}}
                                         </div>
                                        @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Berat Minimal</label>
						<div class="col-sm-10">
							<div class="input-group">							
							<input type="text" class="form-control" id="inputPassword" name="berat_minimal" required onkeypress="return isNumberKey(event)" value="{{$drt->berat_min}}">
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
								<input type="text" class="form-control" id="inputPassword" name="estimasi" required onkeypress="return isNumberKey(event)"value="{{$drt->estimasi}}">
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
					<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label  semibold">Tarif Cabang</label>
						<div class="col-sm-10">
							<select id="exampleSelect" name="cabang" class="form-control">
								@foreach($cabang as $cb)
								<option value="{{$cb->id}}" @if($drt->id_cabang==$cb->id)selected @endif>{{$cb->nama}}</option>
								@endforeach
							</select>
						</div>
					</div>
					{{csrf_field()}}
					<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label  semibold">Status Tarif</label>
						<div class="col-sm-10">
							<select id="exampleSelect" name="status_tarif" class="form-control">
								<option value="N" @if($drt->company=='N')selected @endif>Personal</option>
								<option value="Y" @if($drt->company=='Y')selected @endif>Company</option>
							</select>
						</div>
					</div>
				<input type="hidden" name="_method" value="PUT">
							<small class="text-muted text-right">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
								
							</small>
				</form>
				@endforeach
			</div>
		
		</div>
	</div>

        @endsection