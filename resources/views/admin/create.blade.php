@extends('layout.master')
@section('content')
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Input Admin</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
						<form action="{{ url('admin') }}" role="form" method="POST">

				<h5 class="m-t-lg with-border">Vertical Inputs</h5>

				<div class="row">
					<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">kode admin</label>
							<input type="text" class="form-control" placeholder="First Name" name="kode">

						</fieldset>
					</div>
					<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInputEmail1">username</label>
							<input type="text" class="form-control" placeholder="Enter email"  name="username">
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
							<input type="password" class="form-control" placeholder="Password" name="password">
						</fieldset>
					</div>

				</div><!--.row-->
							<small class="text-muted"><input class="btn btn-primary" type="submit" name="submit" value="simpan"></small>
{{csrf_field()}}
				</form>
			</div>

        @endsection