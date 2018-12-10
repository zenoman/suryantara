@extends('layout.masteradmin')
@section('css')
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/select2.min.css')}}">
@endsection
@section('header')
@foreach($webinfo as $info)
<title>{{$info->namaweb}}</title>
<link href="{{asset('img/setting/'.$info->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('content')
<div class="page-content" id="printdiv">
		<div class="container-fluid">
		
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Buat Surat Jalan</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
					<p>No. Surat : <span id="noresi"></span></p>
				<form action="#" role="form" method="POST">
					<div class="form-group row">
						<input type="hidden" value="{{Session::get('id')}}" id="iduser">
						<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Tujuan</label>
							<div class="input-group">
								<input type="text" class="form-control" id="nama_barang" autofocus>
							</div>
						</div>
					</div>
					
					</div>
					<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Keterangan</label>
							<div class="input-group">
								<textarea rows="4" class="form-control" id="keterangan"></textarea>
							</div>
						</div>
					</div>
					</div>
					{{csrf_field()}}
					<small class="text-muted">
								<button class="btn btn-success" type="button" id="btncetak"> Cetak</button>
								<button class="btn btn-primary" type="button" id="btnsimpan"> Simpan & Selesai</button>
								
								<a onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</a>
					</small>
				</form>
			</div>
		
		</div>

	</div>
        @endsection
@section('js')

<script src="{{asset('assets/js/lib/notie/notie.js')}}"></script>
<script src="{{asset('assets/js/lib/notie/notie-init.js')}}"></script>
<!-- <script src="{{asset('assets/js/resi.js')}}"></script> -->

@endsection
@section('otherjs')
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