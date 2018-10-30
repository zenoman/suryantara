@extends('layout.master')
@section('content')
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Edit Admin</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
						<form action="{{ url('admin/'.$datadmin->id) }}" role="form" method="POST">

				<h5 class="m-t-lg with-border">Vertical Inputs</h5>

				<div class="row">
					<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">kode admin</label>
							<input type="text" class="form-control" placeholder="First Name" name="kode" value="{{$datadmin->kode}}">
							@if($errors->has('kode'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('kode')}}
                                         </div>
                                        @endif
						</fieldset>
					</div>
					<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInputEmail1">username</label>
							<input type="text" class="form-control" placeholder="Enter email"  name="username" value="{{$datadmin->username}}">
						</fieldset>
						@if($errors->has('username'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('username')}}
                                         </div>
                                        @endif
					</div>
					<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" placeholder="Password" name="password" value="{{$datadmin->password}}">
						</fieldset>
						@if($errors->has('password'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('password')}}
                                         </div>
                                        @endif
					</div>

				</div><!--.row-->
{{csrf_field()}}
				<input type="hidden" name="_method" value="PUT">
							<small class="text-muted"><input class="btn btn-primary" type="submit" name="submit" value="simpan"></small>
				</form>
			</div>

        @endsection