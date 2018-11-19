@extends('layout.master')
@section('content')
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Input Tarif Udara</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">

				
				<form action="{{url('trfudara') }}" role="form" method="POST">
					
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="tujuan" placeholder="Misal : Kalimantan" ></p>
							@if($errors->has('tujuan'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('tujuan')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Airlans</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="airlans" placeholder="Misal : LION PREMIUM(JT 786)"></p>
							@if($errors->has('airlans'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('airlans')}}
                                         </div>
                                       @endif
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Genco KG</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="gencoKG" placeholder="Misal : 23613/Kg"></p>
							@if($errors->has('gencoKG'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('gencoKG ')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Minimal</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="minimal" placeholder="Misal : 280000"></p>
							@if($errors->has('minimal'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('minimal')}}
                                         </div>
                                       @endif
						</div>
					</div>

{{csrf_field()}}
							<small class="text-muted">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
							</small>
				</form>
			</div>
        @endsection
