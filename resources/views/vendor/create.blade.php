@extends('layout.masteradmin')

@section('header')
<title>Suryantara</title>
@endsection

@section('content')
<script type="text/javascript">
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</script>
<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Input Vendor</h2>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">

				<form action="{{url('vendor') }}" role="form" method="POST">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Id Vendor</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" placeholder="Text" name="idvendor" ></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="vendor" placeholder="Text Disabled" ></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="telp" required onkeypress="return isNumberKey(event)" placeholder="Text Readonly"></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="alamat" placeholder="Text Readonly"></p>
							@if($errors->has('alamat'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('alamat')}}
                                         </div>
                                       @endif
						</div>
					</div>

{{csrf_field()}}
							<small class="text-muted"><input class="btn btn-primary" type="submit" name="submit" value="simpan">
							<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
						</small>

				</form>
			</div>
	</div>
</div>
        @endsection
