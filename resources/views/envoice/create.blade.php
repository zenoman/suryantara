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
@section('css')

@endsection
@section('content')
<link href="{{asset('assets/js/loading.css')}}" rel="stylesheet">

<div class="page-content" id="printdiv">
		<div class="container-fluid">
		
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Buat Envoice</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="loading-div" id="panelnya">
			<div class="box-typical box-typical-padding">
					<p>No. Surat : <span id="noresi"></span></p>
				<form action="#" role="form" method="POST">
					<div class="form-group row">
						<input type="hidden" value="{{Session::get('username')}}" id="iduser">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Cari Mitra</label>
						<select class="select2" id="carivendor"></select>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">No.telp</label>
							<div class="input-group">
								<input type="text" class="form-control" id="telpvendor" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Alamat</label>
							<div class="input-group">
								<input type="text" class="form-control" id="alamatvendor" readonly>
							</div>
						</div>
					</div>
					</div>
					<hr>
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
					<div class="col-md-5 col-sm-5">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">tujuan</label>
							<div class="input-group">
								<input type="hidden" id="cabang" value="N">
								<input type="text" class="form-control" id="tujuan" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-7 col-sm-7">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Isi Paket</label>
							<div class="input-group">
								<input type="text" class="form-control" id="isipaket" readonly>
								<span class="input-group-btn">
									<button class="btn btn-info ladda-button" data-style="zoom-out" type="button" id="btntambah"><span class="ladda-label">Tambah</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
									</button><button class="btn btn-warning bootstrap-touchspin-up" type="button" id="btnbersihdetail">bersih</button></span>
							</div>
						</div>
					</div>
					</div>
					{{csrf_field()}}
					<table id="table-sm" class="table table-bordered table-hover table-sm">
				<thead>
				<tr>
					<th rowspan="2" class="text-center">No.Resi</th>
					<th rowspan="2" class="text-center">Pengirim</th>
					<th rowspan="2" class="text-center">Penerima</th>
					<th rowspan="2" class="text-center">Tujuan</th>
					<th colspan="2" class="text-center">Jumlah</th>
					<th rowspan="2" class="text-center">Isi Paket</th>
					<th rowspan="2">#</th>
				</tr>
				<tr>
					<th class="text-center">Koli</th>
					<th class="text-center">Kg</th>
				</tr>
				</thead>
				<tbody id="tubuh">
				
				
				</tbody>
				<tfoot>
				<tr>
					<th colspan="4" class="text-center">Total</th>
					<th class="text-center" id="totaljumlah">-</th>
					<th class="text-center" id="totalkg">-</th>
					<th colspan="2" class="text-center">&nbsp;</th>
				</tr>
				
				</tfoot>
			</table>
			<br>
			<input type="hidden" id="totalcash">
			<input type="hidden" id="totalbt">
		
						<!-- <div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya</label>
							<div class="input-group">
								<div class="input-group-addon">Rp</div>
								<input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="biaya_sj">
							</div>
						</div> -->
					
			<hr>
					<small class="text-muted">
								
								<button class="btn btn-primary ladda-button" data-style="zoom-out" id="btnsimpan" type="button"><span class="ladda-label">Simpan & Cetak</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div></button>
								
								<div class="pull-right">
									<button class="btn btn-success ladda-button" data-style="zoom-out" id="btnselesai" type="button"><span class="ladda-label"> Selesai</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div></button>
									<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
								</div>
								
					</small>
				</form>
			</div>
		</div>
		</div>

	</div>
	@include('cetakresi.suratenvoice')


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
<script src="{{asset('assets/js/envoice.js')}}"></script>
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