@extends('layout.masteradminnew')

@section('css')
	<meta name="_token" content="{{ csrf_token() }}"/>
	<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/lib/ladda-button/ladda-themeless.min.css')}}">
@endsection

@section('header')
	@foreach($webinfo as $info)
	<title>{{$info->namaweb}}</title>
	<link href="{{asset('img/setting/'.$info->icon)}}" rel="icon" type="image/png">
	@endforeach
@endsection

@section('content')
<link href="{{asset('assets/js/loading.css')}}" rel="stylesheet">

<div class="page-content" id="printdiv">
		<div class="container-fluid">
		
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Input Paket POD</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="loading-div" id="panelnya">
			<div class="box-typical box-typical-padding">
					
				<form action="{{url('updateinputpod')}}" role="form" method="POST">
					<div class="form-group row">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">No.Resi</label>
						<select class="select2" id="carinoresi"></select>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Pengirim</label>
							<div class="input-group">
								<input type="text" class="form-control" id="pengirim" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Penerima</label>
							<div class="input-group">
								<input type="text" class="form-control" id="penerima" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-4">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Jumlah</label>
							<div class="input-group">
								<input type="text" class="form-control" id="jumlah" onkeypress="return isNumberKey(event)" readonly>
							<div class="input-group-addon">Koli</div>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-4">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Berat</label>
							<div class="input-group">
								<input type="text" class="form-control" id="berat" onkeypress="return isNumberKey(event)" readonly>
							<div class="input-group-addon">Kg</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">tujuan</label>
							<div class="input-group">
								
								<input type="text" class="form-control" id="tujuan" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Isi Paket</label>
							<div class="input-group">
								<input type="text" class="form-control" id="isipaket" readonly>
							</div>
						</div>
					</div>
					
					</div>
					{{csrf_field()}}
					<hr>
					<div class="form-group row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputDisabled">Status</label>
								<select class="form-control" name="statusresi">
									<option value="sukses">Sukses</option>
									<option value="gagal">Gagal</option>
									<option value="retur">Retur</option>
								</select>
								<input type="hidden" id="idresi" name="idresi">
								<input type="hidden" id="kodeantar" name="kodeantar">
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputDisabled">Keterangan / Penerima</label>
								<input type="text" class="form-control" name="keterangan" required>
								</div>
							</div>
						</div>
						<div align="right">
							<button class="btn btn-success" type="submit">Selesai</button>
							<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
						</div>
				</form>
			</div>
		</div>
		</div>

	</div>
	@include('cetakresi.suratjalan')


        @endsection
@section('js')
<script src="{{asset('assets/js/lib/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/lib/notie/notie.js')}}"></script>
<script src="{{asset('assets/js/lib/notie/notie-init.js')}}"></script>
<script src="{{asset('assets/js/lib/ladda-button/spin.min.js')}}"></script>
<script src="{{asset('assets/js/lib/ladda-button/ladda.min.js')}}"></script>

@endsection
@section('otherjs')
<script src="{{asset('assets/js/loading.js')}}"></script>
<script src="{{asset('assets/js/inputpod.js')}}"></script>
<script type="text/javascript">
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

</script>
@endsection