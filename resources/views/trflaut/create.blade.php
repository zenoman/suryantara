@extends('layout.master')
@section('content')
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
						<label class="col-sm-2 form-control-label">Kode</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="kode" ></p>
							 @if($errors->has('kode'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('kode')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Tujuan</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="tujuan" placeholder="Text Disabled" ></p>
							@if($errors->has('tujuan'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('tujuan')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Tarif</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="tarif" placeholder="Text Readonly"></p>
							@if($errors->has('tarif'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('tarif')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Berat minimal</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="berat_minimal" placeholder="Text Readonly"></p>
							@if($errors->has('berat_minimal'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('berat_minimal')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Estimasi</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="estimasi" placeholder="Text Readonly"></p>
							@if($errors->has('estimasi'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('estimasi')}}
                                         </div>
                                       @endif
						</div>
					</div>

{{csrf_field()}}
							<small class="text-muted"><input class="btn btn-primary" type="submit" name="submit" value="simpan"></small>
				</form>
			</div>
        @endsection
