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
<div class="page-content" id="printdiv">
		<div class="container-fluid">
		
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Buat Resi City Kurier Company</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="loading-div" id="panelnya">
			<div class="box-typical box-typical-padding">
				<form action="#" role="form" method="POST">
					<div class="form-group row">
						<input type="hidden" value="{{Session::get('username')}}" id="iduser">
						<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">No. Resi</label>
							<div class="input-group">
								<input type="text" class="form-control" id="koderesi" autofocus>
							</div>
						</div>
					</div>
						<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nama / Isi Barang</label>
							<div class="input-group">
								<input type="text" class="form-control" id="nama_barang">
							</div>
						</div>
					</div>
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
					
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Dimensi Dalam Satuan CM (P, L, T)  </label>
							<div class="input-group">
								<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_panjang" value="0">&nbsp;
								<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_lebar" value="0">&nbsp;
								<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_tinggi" value="0">
									
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Berat Volumetrik</label>
							<div class="input-group">
								<input 
								type="text" 
								class="form-control" 
								id="volume" 
								value="0" 
								onChange="calculate(1)" 
								onkeypress="return isNumberKey2(event)">
								<div class="input-group-addon">Kg</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Jumlah</label>
							<div class="input-group">
								<input type="text" class="form-control" id="jumlah" onkeypress="return isNumberKey(event)">
								<select class="form-control" id="satuan">
								<option value="kg">&nbsp;</option>
								<option value="koli">koli</option>
							</select>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Berat Aktual</label>
							<div class="input-group">
								<input type="text" class="form-control" id="berat" onkeypress="return isNumberKey2(event)">
								<div class="input-group-addon">Kg</div>
							</div>
						</div>
						
					</div>

					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Daerah Asal</label>
							<div class="input-group">
								<input type="text" value="{{session::get('kota')}}" readonly class="form-control" id="kota_asal" >
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<label class="form-label" for="exampleInputDisabled">Daerah Tujuan</label>
						<select class="select2" id="kota_tujuan"></select>
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
							<label class="form-label" for="exampleInputDisabled">Biaya Packing</label>
							<div class="input-group">
								<input type="text" class="form-control" id="biaya_packing" value="0" onkeypress="return isNumberKey(event)">
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya Asuransi</label>
							<div class="input-group">
								<input type="text" class="form-control" id="biaya_asuransi" value="0" onkeypress="return isNumberKey(event)">
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
										<td>Biaya Packing</td>
										<td id="b_packing">0</td>
									</tr>
									<tr>
										<td>Biaya Asuransi</td>
										<td id="b_asuransi">0</td>
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
					<input type="hidden" class="form-control" id="keterangan" value="pengiriman darat">
					{{csrf_field()}}
						<small class="text-muted">
							<button class="btn btn-primary ladda-button" data-style="zoom-out" id="btnsimpan"><span class="ladda-label">Simpan</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
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
	</div>
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
<script src="{{asset('assets/js/resicitycmp.js')}}"></script>
<script type="text/javascript">
     function isNumberKey2(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

</script>

@endsection