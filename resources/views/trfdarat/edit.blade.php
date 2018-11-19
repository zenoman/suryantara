@extends('layout.master')
@section('content')
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
						<form action="{{ url('trfdarat/'.$trf_drt->id) }}" role="form" method="POST">

				<!--<h5 class="m-t-lg with-border">Vertical Inputs</h5>-->

				<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold	">Kode</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="kode" value="{{$trf_drt->kode}}"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="tujuan" value="{{$trf_drt->tujuan}}"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="tarif" value="{{$trf_drt->tarif}}"></p>
						@if($errors->has('tarif'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('tarif')}}
                                         </div>
                                        @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Berat Minimal</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="berat_minimal" value="{{$trf_drt->berat_min}}"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="estimasi" value="{{$trf_drt->estimasi}}"></p>
						@if($errors->has('estimasi'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('estimasi')}}
                                         </div>
                                        @endif
						</div>
					</div>
{{csrf_field()}}
				<input type="hidden" name="_method" value="PUT">
							<small class="text-muted">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
							</small>
				</form>
			</div>

        @endsection