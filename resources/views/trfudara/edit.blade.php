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
							<h2>Edit tarif Udara</h2>
						</div>
					</div>
				</div>
			</header>
 @foreach($trfudara as $row)

			<div class="box-typical box-typical-padding">
						<form action="/trfudara/{{$row->id}}" role="form" method="POST" enctype="multipart/form-data">
			
				<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold	">Kode</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="kode" value="{{$row->kode}}"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="tujuan" value="{{$row->tujuan}}"></p>
						@if($errors->has('tujuan'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('tujuan')}}
                                         </div>
                                        @endif
						</div>
					</div>
				<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Airlines</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="airlans" value="{{$row->airlans}}"></p>
						@if($errors->has('airlans'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('airlans')}}
                                         </div>
                                        @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Genco per Kg</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" required onkeypress="return isNumberKey(event)" placeholder="Text" name="gencoKG" value="{{$row->gencoKG}}"></p>
						@if($errors->has('gencoKG'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('gencoKG')}}
                                         </div>
                                        @endif
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Minimal</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" required onkeypress="return isNumberKey(event)" placeholder="Text" name="minimal" value="{{$row->minimal}}"></p>
						@if($errors->has('minimal'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('minimal')}}
                                         </div>
                                        @endif
						</div>
					</div>
					@endforeach
					
					@foreach($udaracargo as $ro)
					<input type="hidden" name="id_cargo" value="{{$ro->id}}">
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Tarif</label>
						<div class="col-sm-10">
							<div class="input-group">

							<div class="input-group-addon">
									Rp.
								</div>

							<input type="text" class="form-control" id="inputPassword"  name="tarif" required onkeypress="return isNumberKey(event)" value="{{$ro->tarif}}">
							
							</div>
							@if($errors->has('tarif')){
                                       <div class="alert alert-danger">
                                        {{ $errors->first('tarif')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Persentase</label>
						<div class="col-sm-10">
							<div class="input-group">

							<div class="input-group-addon">
									<b>%</b>
								</div>
								<input type="text" class="form-control" id="inputPassword" name="persentase" required onkeypress="return isNumberKey(event)" placeholder="Text Readonly" value="{{$ro->persentase}}"></p>
							@if($errors->has('persentase'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('persentase')}}
                                         </div>
                                       @endif
						</div>
					</div>
						@endforeach
			</div>
{{csrf_field()}}
				<input type="hidden" name="_method" value="PUT">
							<small class="text-muted">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
							</small>
				</form>
			</div>
	</div>
</div>
        @endsection