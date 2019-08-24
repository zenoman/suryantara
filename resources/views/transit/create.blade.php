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
							<h2>Tambah Transit</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="loading-div" id="panelnya">
			<div class="box-typical box-typical-padding">
				<form onsubmit="return valida()" action="{{url('simpantransit')}}" role="form" method="POST">
					<div class="form-group row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Cari Surat Jalan</label>
						<select class="select2" name="idsuratjalan" id="carisuratjalan"></select>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Tujuan</label>
							@csrf
							<div class="input-group">
								<input type="text" class="form-control" id="tujuan" name="tujuan" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Alamat</label>
							<div class="input-group">
								<input type="text" name="alamat" class="form-control" id="alamat" readonly>
								<input type="hidden" name="kodejalan" id="kodejalan">
							</div>
						</div>
					</div>
					</div>
					<hr>
					
					<table id="table-sm" class="table table-bordered table-hover table-sm">
				<thead>
				<tr>
					<th rowspan="2" class="text-center">No.Resi</th>
					<th rowspan="2" class="text-center">Pengirim</th>
					<th rowspan="2" class="text-center">Penerima</th>
					<th rowspan="2" class="text-center">Tujuan</th>
					<th colspan="2" class="text-center">Jumlah</th>
					<th rowspan="2" class="text-center">Isi Paket</th>
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
					
			<hr>
			<div class="form-group row">
					<div class="col-md-12 col-sm-12 pull-right">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
					</div>
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
@endsection

@section('otherjs')
<script src="{{asset('assets/js/loading.js')}}"></script>
<script src="{{asset('assets/js/transit.js')}}"></script>
@endsection