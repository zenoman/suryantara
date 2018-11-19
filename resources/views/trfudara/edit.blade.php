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

			
				<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold	">Kode</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="kode" value="{{$trfudara->kode}}"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="tujuan" value="{{$trfudara->tujuan}}"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="airlans" value="{{$trfudara->airlans}}"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="gencoKG" value="{{$trfudara->gencoKG}}"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="minimal" value="{{$trfudara->minimal}}"></p>
						@if($errors->has('minimal'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('minimal')}}
                                         </div>
                                        @endif
						</div>
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