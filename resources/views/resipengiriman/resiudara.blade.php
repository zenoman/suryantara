@extends('layout.masteradminnew')

@section('css')
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
<script>
	function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57)){
         	return false;
         }else{
         	return true;
         	
         }
        
      } function isNumberKey2(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</script>
<div class="page-content" id="printdiv">
		<div class="container-fluid">
		
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Buat Resi Pengiriman Udara</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="loading-div" id="panelnya">
			<div class="box-typical box-typical-padding">
					<p>No. Resi : <span id="noresi"></span></p>
				<form action="#" role="form" method="POST">
					<div class="form-group row">
						<input type="hidden" value="{{Session::get('username')}}" id="iduser">
						<div class="col-md-8 col-sm-8">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nama / Isi Barang</label>
							<div class="input-group">
								<input type="text" class="form-control" id="nama_barang" autofocus>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Kategori barang</label>
							<div class="input-group">
								<select class="form-control" id="kategori">
								<option value="biasa"></option>
								@foreach($kategori as $kat)
								<option value="{{$kat->charge}}">{{$kat->spesial_cargo}} ({{$kat->charge}}%)</option>
								@endforeach
							</select>
							</div>
						</div>
					</div>
					
					
					</div>
					<hr>

					<div class="row" id="rowjumlah1">
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Dimensi Dalam Satuan <b>cm</b> (P, L, T)  </label>
							<div class="input-group">
								<input 
								type="text" 
								onkeypress="return isNumberKey(event)"
								class="col-sm-4 col-md-4 form-control volume" id="d_panjang1" value="0" data-no="1" onchange="hayy(1)">&nbsp;
								<input type="text" onkeypress="return isNumberKey(event)"
								onchange="hayy(1)" class="col-sm-4 col-md-4 form-control volume" id="d_lebar1" value="0"data-no="1">&nbsp;
								<input type="text" onkeypress="return isNumberKey(event)"
								onchange="hayy(1)" class="col-sm-4 col-md-4 form-control volume" id="d_tinggi1" value="0" data-no="1">
									
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Berat Volumetrik</label>
							<div class="input-group">
								<input type="text" class="form-control" id="volume1" onkeypress="return isNumberKey2(event)" onchange="hitungberat()" value="0" data-no="1">
								<div class="input-group-addon">Kg</div>
								
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Berat Aktual</label>
							<div class="input-group">
								<input type="text" class="form-control" id="berat1" onkeypress="return isNumberKey2(event)" onchange="hitungberat()" value="0">
								<div class="input-group-addon">Kg</div>
							</div>
						</div>
					</div>
					</div>
				<div id="kolomjumlah">
					
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Metode Bayar</label>
							<div class="input-group">
								<select class="form-control" id="metode">
								<option value="cash">cash</option>
								<option value="bt">BT</option>
							</select>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Jumlah</label>
							<div class="input-group">
								<input type="text" class="form-control" id="jumlah" value="1" readonly>
								<select class="form-control" id="satuan">
								<option value="kg">&nbsp;</option>
								<option value="koli">koli</option>
							</select>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Berat Total</label>
							<div class="input-group">
								<input type="text" class="form-control" id="totalberat" value="0" readonly>
							</div>
						</div>
					</div>
						<div class="col-md-1 col-sm-1">
							<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">&nbsp;</label>
							<div class="input-group">
							<button type="button" id="tambahjumlah" class="btn btn-warning"> Tambah Jumlah</button>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12">
				<p id="msgheavy" class="text-danger"></p>
			</div>
				</div>

				<hr>
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Kota Asal</label>
							<div class="input-group">
								<input type="text" class="form-control" id="kota_asal" value="{{session::get('kota')}}" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-8 col-sm-8">
						<label class="form-label" for="exampleInputDisabled">Kota Tujuan</label>
						<select class="select2" id="kota_tujuan"></select>
						<input type="hidden" id="min_heavy" value="0">
					</div>
					<div class="col-md-3 col-sm-3">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya Per<b>Kg</b></label>
							<div class="input-group">
								<input type="text" class="form-control" id="bpk" value="0" readonly>
								
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Min. Heavy Cargo</label>
							<div class="input-group">
								<input type="text" class="form-control" id="tmh" value="0" readonly>
								
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nomer SMU (Boleh Kosong)</label>
							<div class="input-group">
								<input type="text" class="form-control" id="nomer_smu">
							</div>
						</div>
					</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nama Pengirim</label>
							<div class="input-group">
								<input type="text" class="form-control" id="n_pengirim">
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Telp Pengirim</label>
							<div class="input-group">
								<input type="text" onkeypress="return isNumberKey(event)" class="form-control" id="t_pengirim" >
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Alamat Pengirim</label>
							<div class="input-group">
								<input type="text" class="form-control" id="alamat_pengirim" >
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nama Penerima</label>
							<div class="input-group">
								<input type="text" class="form-control" id="n_penerima" >
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Telp Penerima</label>
							<div class="input-group">
								<input type="text" onkeypress="return isNumberKey(event)" class="form-control" id="t_penerima" >
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Alamat Penerima</label>
							<div class="input-group">
								<input type="text" class="form-control" id="alamat_penerima" >
							</div>
						</div>
					</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-7 col-md-7">
						<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya Kirim</label>
							<div class="input-group">
								<input type="text" class="form-control" id="biaya_kirim" value="0" onkeypress="return isNumberKey(event)">
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya SMU</label>
							<div class="input-group">
								<input type="text" class="form-control" id="biaya_smu" value="0" onkeypress="return isNumberKey(event)">
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya Karantina</label>
							<div class="input-group">
								<input type="text" class="form-control" id="biaya_karantina" value="0" onkeypress="return isNumberKey(event)">
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Dibayar</label>
							<div class="input-group">
								<input type="text" class="form-control" id="dibayar" value="0" onkeypress="return isNumberKey(event)">
							</div>
						</div>
						<input type="hidden" id="status_bayar" value="lunas">
					</div>
						</div>
						<div class="col-md-5 col-sm-5">
							<table class="table table-bordered" id="estimasi">
								<thead>
									<tr>
										<th colspan="2" class="text-center">Estimasi Biaya</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Biaya Kirim</td>
										<td id="b_kirim">0</td>
									</tr>
									<tr>
										<td>Biaya SMU</td>
										<td id="b_smu">0</td>
									</tr>
									<tr>
										<td>Biaya Karantina</td>
										<td id="b_karantina">0</td>
									</tr>
									
									<tr>
										<td>Charge</td>
										<td id="b_charge">0</td>
									</tr>
									<tr>
										<td class="text-right"><h5>Subtotal</h5></td>
										<td><h5 id="subtotal">0</h5></td>
									</tr>
									<tr>
										<td class="text-right"><h5>Dibayar</h5></td>
										<td><h5 id="b_dibayar">0</h5></td>
									</tr>
									<tr>
										<td class="text-right" id="ketuang">Kembalian/Kekurangan</td>
										<td id="total">0</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<hr>
					<input type="hidden" value="pengiriman udara" class="form-control" id="keterangan">
					{{csrf_field()}}
							<small class="text-muted">
								

								<button class="btn btn-primary ladda-button" data-style="zoom-out" id="btnsimpan"><span class="ladda-label">Simpan & Cetak</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
								</button>
								
								
								<div class="pull-right">
									<button class="btn btn-success" type="button" id="btnselesai"> Selesai</button>
									<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
								</div>
								
							</small>
				</form>
			</div>
		</div>
		</div>
	
		@include('cetakresi.resiudara')
		
	
	</div>
        @endsection
@section('js')
<script src="{{asset('assets/js/loading.js')}}"></script>

<script src="{{asset('assets/js/lib/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/lib/notie/notie.js')}}"></script>
<script src="{{asset('assets/js/lib/notie/notie-init.js')}}"></script>
<script src="{{asset('assets/js/lib/ladda-button/spin.min.js')}}"></script>
<script src="{{asset('assets/js/lib/ladda-button/ladda.min.js')}}"></script>
@endsection

@section('otherjs')
<script src="{{asset('assets/js/resiudara.js')}}"></script>
<script type="text/javascript">
     
</script>

@endsection