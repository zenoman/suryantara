@extends('layout.master')
@section('content')
	<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Edit tarif Udara</h2>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
						<form action="{{ url('trfudara/'.$trfudara->id) }}" role="form" method="POST">

				<h5 class="m-t-lg with-border">Vertical Inputs</h5>

				<div class="row">
					<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">kode</label>
							<input type="text" class="form-control" placeholder="First Name" name="kode" value="{{$trfudara->kode}}">
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
							<input type="text" class="form-control" placeholder="Enter email"  name="tujuan" value="{{$trfudara->tujuan}}">
						</fieldset>
						@if($errors->has('tujuan'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('tujuan')}}
                                         </div>
                                        @endif
					</div>
					<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInputairlans1">airlans</label>
							<input type="text" class="form-control" placeholder="airlans" name="airlans" value="{{$trfudara->airlans}}">
						</fieldset>
						@if($errors->has('airlans'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('airlans')}}
                                         </div>
                                        @endif
					</div>

				</div><!--.row-->
					<div class="form-group row">

					<div class="col-lg-6">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Genco KG</label>
							<input type="text" class="form-control" placeholder="First Name" name="gencoKG" value="{{$trfudara->gencoKG}}">
							@if($errors->has('gencoKG'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('gencoKG')}}
                                         </div>
                                       @endif
						</fieldset>
					</div>
					<div class="col-lg-6">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInput">Minimal</label>
							<input type="text" class="form-control" placeholder="Enter email"  name="minimal" value="{{$trfudara->minimal}}">
							@if($errors->has('minimal'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('minimal')}}
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