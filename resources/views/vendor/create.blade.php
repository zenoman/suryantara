@extends('layout.masteradmin')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
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
						<label class="col-sm-2 form-control-label semibold">Id Vendor</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" placeholder="Masukkan Kode Vendor" name="idvendor" ></p>
							 @if($errors->has('idvendor'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('idvendor')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Vendor</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="vendor" placeholder="Nama Vendor" ></p>
							@if($errors->has('vendor'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('vendor')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Telp</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="telp" required onkeypress="return isNumberKey(event)" placeholder="Misal : 085**********"></p>
							@if($errors->has('telp'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('telp')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Alamat</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="alamat" placeholder="Masukkan Alamat"></p>
							@if($errors->has('alamat'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('alamat')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Status Vendor</label>
						<div class="col-sm-10">
							<div class="checkbox-detailed">
								<input type="radio" name="cabang" id="check-det-1" checked value="N" />
								<label for="check-det-1">
								<span class="checkbox-detailed-tbl">
									<span class="checkbox-detailed-cell">
										<!--<span class="checkbox-detailed-title">Vendor</span>-->
										<b>Lainya</b>
									</span>
								</span>
								</label>
							</div>
							<div class="checkbox-detailed">
								<input type="radio" name="cabang" id="check-det-2" value="Y" />
								<label for="check-det-2">
								<span class="checkbox-detailed-tbl">
									<span class="checkbox-detailed-cell">
										<!--<span class="checkbox-detailed-title">Vendor</span>-->
										<b>Cabang</b>
									</span>
								</span>
								</label>
							</div>
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
