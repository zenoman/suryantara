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

				<h5 class="m-t-lg with-border">Tambah tarid udara</h5>
				<form action="{{url('trfudara') }}" role="form" method="POST">
					
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
						<label class="col-sm-2 form-control-label">Airlans</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="airlans" placeholder="Text Readonly"></p>
							@if($errors->has('airlans'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('airlans')}}
                                         </div>
                                       @endif
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Genco KG</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="gencokg" placeholder="Text Readonly"></p>
							@if($errors->has('gencokg'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('gencokg')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Minimal</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="minimal" placeholder="Text Readonly"></p>
							@if($errors->has('minimal'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('minimal')}}
                                         </div>
                                       @endif
						</div>
					</div>

{{csrf_field()}}
							<small class="text-muted"><input class="btn btn-primary" type="submit" name="submit" value="simpan"></small>
				</form>
			</div>
        @endsection
