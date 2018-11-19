@extends('layout.master')
@section('content')
		<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Edit Udara Kargo</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
						<form action="{{ url('udrkargo/'.$udaracargo->id) }}" role="form" method="POST">
					
					<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label">Kode Udara</label>
						<div class="col-sm-10">
							<select id="exampleSelect" class="form-control" name="kode_udara">
								<option value="{{$udaracargo->kode_udara}}">1</option>
								<option>4</option>
							</select>
							@if($errors->has('kode_udara'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('kode_udara')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Tarif</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="tarif" placeholder="Text Disabled" value="{{$udaracargo->tarif}}" ></p>
							@if($errors->has('tarif'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('tarif')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Persentase</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="persentase" placeholder="Text Readonly" value="{{$udaracargo->persentase}}"></p>
							@if($errors->has('persentase'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('persentase')}}
                                         </div>
                                       @endif
						</div>
					</div>
{{csrf_field()}}
				<input type="hidden" name="_method" value="PUT">
							<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a></small>
							<small class="text-muted"><input class="btn btn-primary" type="submit" name="submit" value="simpan">
				</form>
			</div>

        @endsection