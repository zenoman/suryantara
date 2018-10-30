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

				<h5 class="m-t-lg with-border">Vertical Inputs</h5>

				<div class="row">
					<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">kode</label>
							<input type="text" class="form-control" placeholder="First Name" name="kode" value="{{$trf_drt->kode}}">
							@if($errors->has('kode'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('kode')}}
                                         </div>
                                        @endif
						</fieldset>
					</div>
					<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInputEmail1">tujuan</label>
							<input type="text" class="form-control" placeholder="Enter email"  name="tujuan" value="{{$trf_drt->tujuan}}">
						</fieldset>
						@if($errors->has('tujuan'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('tujuan')}}
                                         </div>
                                        @endif
					</div>
					<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInputairlans1">Tarif</label>
							<input type="text" class="form-control"  name="tarif" value="{{$trf_drt->tarif}}">
						</fieldset>
						@if($errors->has('tarif'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('tarif')}}
                                         </div>
                                        @endif
					</div>

				</div><!--.row-->
					<div class="form-group row">

					<div class="col-lg-6">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Berat minimal</label>
							<input type="text" class="form-control" placeholder="First Name" name="berat_minimal" value="{{$trf_drt->berat_min}}">
							@if($errors->has('berat_minimal'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('berat_minimal')}}
                                         </div>
                                       @endif
						</fieldset>
					</div>
					<div class="col-lg-6">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInput">Minimal</label>
							<input type="text" class="form-control" placeholder="Enter email"  name="estimasi" value="{{$trf_drt->estimasi}}">
							@if($errors->has('estimasi'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('estimasi')}}
                                         </div>
                                       @endif
						</fieldset>
					</div>

			</div>
{{csrf_field()}}
				<input type="hidden" name="_method" value="PUT">
							<small class="text-muted"><input class="btn btn-primary" type="submit" name="submit" value="simpan"></small>
				</form>
			</div>

        @endsection