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
					<div class="col-md-3 col-sm-3">
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
					<div class="col-md-3 col-sm-3">
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
								<input type="text" class="form-control" id="kota_asal" >
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
							<label class="form-label" for="exampleInputDisabled">Telfon Pengirim</label>
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
							<label class="form-label" for="exampleInputDisabled">Telfon Penerima</label>
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
										<td colspan="2" class="text-center">
											<h3 id="total">0</h3>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<hr>
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
	<div id="hidden_div" style="display: none;">
		<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center" >
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35% " align="right" id="cetak_resi"></p> 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Udara</p> 
								<p style="margin-right: 7px;" align="right">Tanggal : <?php echo date('d-m-Y');?></p> 
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 100%;border-collapse:collapse;border: 1px solid black;">
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Pengirim</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Deskripsi</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Syarat-syarat</td>
				
			</tr>
			<tr>
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_pengirim"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_pengirim"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_pengirim"></td>
						</tr>
					</table>
				</td>
				<td rowspan="3" style="border: 1px solid black;">
					<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
					<td>
						<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
							<td style="width: 25%;font-size: 10;">Isi Paket</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_isi_paket"></td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;">Jumlah</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;"><span id="cetak_jumlah_barang"></span></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Total Berat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_berat"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.SMU</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_nosmu"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Metode</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;">
								<b><span id="cetak_metode"></span></b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Kota asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_asal"></span>
											</b>
										</td>
										<td style="font-size: 11;">Tujuan&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_tujuan"></span>
											</b>
										</td>
									</tr>
								</table>
							</td>
							<td></td>
						</tr>
					</table>
					</td>
						</tr>
				<tr>
					<td style="width:40%;">
					<table style="width: 100%;border-collapse:collapse; font-size: 7;" border="1">
						<thead>
						<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>	
						</thead>
						<tbody  id="listbarang">
							
						</tbody>
					</table>
				</td>
				</tr>
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 4; padding-left: 7px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol><hr>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_kirim"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">SMU</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_smu"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Karantina</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_karantina"></td>
						</tr>
						
						
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Surcharge</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_charge"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total Biaya</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b id="cetak_total"></b>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Penerima</td>
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_penerima"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_penerima"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_penerima"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 35%;">
							<p style="margin-left: 1%;margin-right: 1%;font-size: 10;">
							Pengirim dengan ini menyatakan bahwa keterangan yang ada pada resi ini benar dan telah memenuhi syarat.
							</p>
							<br>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
							<td style="border-left: 1px solid black; width: 30%;">
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal"></p>
									<br>
									<p align="center" style="font-size: 9">Tanda Tangan Petugas</p>
							
							</td>
							<td style="border-left: 1px solid black; width: 35%;">
								<p style="font-size: 10;margin-left: 1%;">Penerima telah menerima barang dalam keadaan baik pada <br><br>
									Tanggal&nbsp;&nbsp;:........................................ 
									<br><br>								Jam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:........................................
								</p>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
			</tr>
		</table>
	</div>
	<p style="font-size: 10;">pengirim</p>
	<hr>
	<!-- ============================================== -->




	<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center" >
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35% " align="right" id="cetak_resi2"></p> 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Udara</p> 
								<p style="margin-right: 7px;" align="right">Tanggal : <?php echo date('d-m-Y');?></p> 
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 100%;border-collapse:collapse;border: 1px solid black;">
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Pengirim</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Deskripsi</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Syarat-syarat</td>
				
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_pengirim2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_pengirim2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_pengirim2"></td>
						</tr>
					</table>
				</td>
				<td rowspan="3" style="border: 1px solid black;">
					<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
					<td>
						<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
							<td style="width: 25%;font-size: 10;">Isi Paket</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_isi_paket2"></td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;">Jumlah</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;"><span id="cetak_jumlah_barang2"></span></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Total Berat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_berat2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.SMU</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_nosmu2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Metode</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;">
								<b><span id="cetak_metode2"></span></b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Kota asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_asal2"></span>
											</b>
										</td>
										<td style="font-size: 11;">Tujuan&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_tujuan2"></span>
											</b>
										</td>
									</tr>
								</table>
							</td>
							<td></td>
						</tr>
					</table>
					</td>
						</tr>
				<tr>
					<td style="width:40%;">
					<table style="width: 100%;border-collapse:collapse; font-size: 7;" border="1">
						<thead>
							<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>
						</thead>
						<tbody id="listbarang2">
							
						</tbody>
						
					</table>
				</td>
				</tr>
				
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 4; padding-left: 7px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol><hr>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_kirim2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">SMU</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_smu2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Karantina</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_karantina2"></td>
						</tr>
						
						
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Surcharge</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_charge2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total Biaya</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b id="cetak_total2"></b>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Penerima</td>
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_penerima2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_penerima2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_penerima2"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 35%;">
							<p style="margin-left: 1%;margin-right: 1%;font-size: 10;">
							Pengirim dengan ini menyatakan bahwa keterangan yang ada pada resi ini benar dan telah memenuhi syarat.
							</p>
							<br>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
							<td style="border-left: 1px solid black; width: 30%;">
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal2"></p>
									<br>
									<p align="center" style="font-size: 9">Tanda Tangan Petugas</p>
							
							</td>
							<td style="border-left: 1px solid black; width: 35%;">
								<p style="font-size: 10;margin-left: 1%;">Penerima telah menerima barang dalam keadaan baik pada <br><br>
									Tanggal&nbsp;&nbsp;:........................................ 
									<br><br>								Jam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:........................................
								</p>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
			</tr>
		</table>
	</div>
	<p style="font-size: 10;">asal</p>
	<hr>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<!-- ============================================== -->



	<hr>
	<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center" >
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35% " align="right" id="cetak_resi3"></p> 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Udara</p> 
								<p style="margin-right: 7px;" align="right">Tanggal : <?php echo date('d-m-Y');?></p> 
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 100%;border-collapse:collapse;border: 1px solid black;">
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Pengirim</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Deskripsi</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Syarat-syarat</td>
				
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_pengirim3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_pengirim3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_pengirim3"></td>
						</tr>
					</table>
				</td>
				<td rowspan="3" style="border: 1px solid black;">
					<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
					<td>
						<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
							<td style="width: 25%;font-size: 10;">Isi Paket</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_isi_paket3"></td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;">Jumlah</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;"><span id="cetak_jumlah_barang3"></span></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Total Berat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_berat3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.SMU</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_nosmu3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Metode</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;">
								<b><span id="cetak_metode3"></span></b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Kota asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_asal3"></span>
											</b>
										</td>
										<td style="font-size: 11;">Tujuan&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_tujuan3"></span>
											</b>
										</td>
									</tr>
								</table>
							</td>
							<td></td>
						</tr>
					</table>
					</td>
						</tr>
				<tr>
					<td style="width:40%;">
					<table style="width: 100%;border-collapse:collapse; font-size: 7;" border="1">
						<thead>
						<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>	
						</thead>
						<tbody id="listbarang3">
							
						</tbody>
					</table>
				</td>
				</tr>
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 4; padding-left: 7px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol><hr>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_kirim3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">SMU</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_smu3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Karantina</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_karantina3"></td>
						</tr>
						
						
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Surcharge</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_charge3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total Biaya</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b id="cetak_total3"></b>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Penerima</td>
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_penerima3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_penerima3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_penerima3"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 35%;">
							<p style="margin-left: 1%;margin-right: 1%;font-size: 10;">
							Pengirim dengan ini menyatakan bahwa keterangan yang ada pada resi ini benar dan telah memenuhi syarat.
							</p>
							<br>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
							<td style="border-left: 1px solid black; width: 30%;">
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal3"></p>
									<br>
									<p align="center" style="font-size: 9">Tanda Tangan Petugas</p>
							
							</td>
							<td style="border-left: 1px solid black; width: 35%;">
								<p style="font-size: 10;margin-left: 1%;">Penerima telah menerima barang dalam keadaan baik pada <br><br>
									Tanggal&nbsp;&nbsp;:........................................ 
									<br><br>								Jam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:........................................
								</p>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
			</tr>
		</table>
	</div>
	<p style="font-size: 10;">tujuan</p>
	<hr>
	<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center" >
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35% " align="right" id="cetak_resi4"></p> 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Udara</p> 
								<p style="margin-right: 7px;" align="right">Tanggal : <?php echo date('d-m-Y');?></p> 
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 100%;border-collapse:collapse;border: 1px solid black;">
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Pengirim</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Deskripsi</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Syarat-syarat</td>
				
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_pengirim4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_pengirim4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_pengirim4"></td>
						</tr>
					</table>
				</td>
				<td rowspan="3" style="border: 1px solid black;">
					<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
					<td>
						<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
							<td style="width: 25%;font-size: 10;">Isi Paket</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_isi_paket4"></td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;">Jumlah</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;"><span id="cetak_jumlah_barang4"></span></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Total Berat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_berat4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.SMU</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_nosmu4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Metode</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;">
								<b><span id="cetak_metode4"></span></b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Kota asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_asal4"></span>
											</b>
										</td>
										<td style="font-size: 11;">Tujuan&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_tujuan4"></span>
											</b>
										</td>
									</tr>
								</table>
							</td>
							<td></td>
						</tr>
					</table>
					</td>
						</tr>
				<tr>
					<td style="width:40%;">
					<table style="width: 100%;border-collapse:collapse; font-size: 7;" border="1">
						<thead>
						<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>
						</thead>
						<tbody  id="listbarang4">
							
						</tbody>
					</table>
				</td>
				</tr>
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 4; padding-left: 7px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol><hr>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_kirim4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">SMU</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_smu4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Karantina</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_karantina4"></td>
						</tr>
						
						
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Surcharge</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_charge4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total Biaya</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b id="cetak_total4"></b>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Penerima</td>
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_penerima4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_penerima4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_penerima4"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 35%;">
							<p style="margin-left: 1%;margin-right: 1%;font-size: 10;">
							Pengirim dengan ini menyatakan bahwa keterangan yang ada pada resi ini benar dan telah memenuhi syarat.
							</p>
							<br>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
							<td style="border-left: 1px solid black; width: 30%;">
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal4"></p>
									<br>
									<p align="center" style="font-size: 9">Tanda Tangan Petugas</p>
							
							</td>
							<td style="border-left: 1px solid black; width: 35%;">
								<p style="font-size: 10;margin-left: 1%;">Penerima telah menerima barang dalam keadaan baik pada <br><br>
									Tanggal&nbsp;&nbsp;:........................................ 
									<br><br>								Jam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:........................................
								</p>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
			</tr>
		</table>
	</div>
	<p style="font-size: 10;">penerima</p>
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
<script src="{{asset('assets/js/resiudara.js')}}"></script>
<script type="text/javascript">
     
</script>

@endsection