@extends('layout.master')
@section('content')
		<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Edit Vendor</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<form action="{{url('vendor/'.$vendor->id) }}" role="form" method="POST">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Id Vendor</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="idvendor" value="{{$vendor->idvendor}}"></p>
						@if($errors->has('idvendor'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('idvendor')}}
                                         </div>
                                        @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Vendor</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="vendor" placeholder="Text Disabled" value="{{$vendor->vendor}}"></p>
						@if($errors->has('vendor'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('vendor')}}
                                         </div>
                                        @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Telp</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="telp" placeholder="Text Readonly" value="{{$vendor->telp}}"></p>
						@if($errors->has('telp'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('telp')}}
                                         </div>
                                        @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Alamat</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="alamat" placeholder="Text Readonly" value="{{$vendor->alamat}}"></p>
						@if($errors->has('alamat'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('alamat')}}
                                         </div>
                                        @endif
						</div>
					</div>
{{csrf_field()}}
				<input type="hidden" name="_method" value="PUT">
							<small class="text-muted"><input class="btn btn-primary" type="submit" name="submit" value="simpan">
							<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
						</small>
				</form>
			</div>
        @endsection