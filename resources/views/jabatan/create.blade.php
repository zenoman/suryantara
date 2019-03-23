@extends('layout.masteradminnew')

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
							<h2>Input Jabatan</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<form action="{{ url('jabatan') }}" role="form" method="POST">
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama Jabatan</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input 
								type="text" 
								class="form-control" 
								placeholder="Masukan Nama Jabatan" name="jabatan"
								required 
								></p>
							 @if($errors->has('jabatan'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('jabatan')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Gaji Pokok</label>
						<div class="col-sm-10">
							<div class="input-group">
								<div class="input-group-addon">
									Rp.
								</div>
								<input
								type="text"
								class="form-control"
								name="gaji_pokok" 
								required 
								onkeypress="return isNumberKey(event)" 
								placeholder="Misal :Rp 23000">
							</div>
							@if($errors->has('gaji_pokok'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('gaji_pokok')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Uang Makan</label>
						<div class="col-sm-10">
							<div class="input-group">
								<div class="input-group-addon">
									Rp.
								</div>
								<input 
								type="text" 
								class="form-control" 
								name="uang_makan" 
								required 
								onkeypress="return isNumberKey(event)" 
								placeholder="Misal :Rp 23000">
							</div>
							@if($errors->has('uang_makan'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('uang_makan')}}
                                         </div>
                                       @endif
						</div>
					</div>

{{csrf_field()}}
							<small class="text-muted">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
							</small>
				</form>
			</div>
			</div>
			</div>
        @endsection
