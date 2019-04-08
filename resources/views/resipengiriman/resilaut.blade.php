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
							<h2>Buat Resi Pengiriman Laut</h2>
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
						<div class="col-md-9 col-sm-9">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nama / Isi Barang</label>
							<div class="input-group">
								<input type="text" class="form-control" id="nama_barang" autofocus>
							</div>
						</div>
					</div>
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
								<input type="text" class="form-control" id="volume" onkeypress="return isNumberKey2(event)">
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
							<label class="form-label" for="exampleInputDisabled">Kota Asal</label>
							<div class="input-group">
								<input type="text" class="form-control" id="kota_asal" >
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<label class="form-label" for="exampleInputDisabled">Kota Tujuan</label>
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
										<td colspan="2" class="text-center">
											<h3 id="total">0</h3>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<hr>
					<!-- <div class="row">
						<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Keterangan</label>
							<div class="input-group">-->
								<input type="hidden" value="pengiriman laut" class="form-control" id="keterangan">
							<!--</div>
						</div>
					</div>
					</div> -->
					{{csrf_field()}}
							<small class="text-muted">
								<!-- <button class="btn btn-success" type="button" id="btncetak"> Cetak</button> -->

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
<div id="hidden_div" style="display: none;">
     <div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%">
				<p style="font-size:10;" align="center">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35%;font-size: 10; " align="right"><b id="cetak_resi"></b></p> 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Laut</p> 
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
							<td style="font-size: 10;" id="cetak_jumlah_barang"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Metode</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;">
								<b><span id="cetak_metode">
									
								</span></b>
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
					<table style="width: 100%;border-collapse:collapse; font-size: 6;" border="1">
						<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid black; border-bottom: 1px solid black;" align="center" id="cetak_dimensi"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_volumetrik"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_berat"></td>
						</tr>
					</table>
				</td>
				</tr>
						<tr>
					<td>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_kirim"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Packing</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_packing"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Asuransi</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_asu"></td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b id="cetak_total"></b>
							</td>
						</tr>
					</table>
					</td>
				</tr>
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 8;padding-left: 10px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol>
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
	<!-- ================================================ -->	
	<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center">
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35%;font-size: 10; " align="right"><b id="cetak_resi2"></b></p> 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Laut</p> 
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
							<td style="font-size: 10;" id="cetak_jumlah_barang2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Metode</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;">
								<b><span  id="cetak_metode2">
									
								</span></b>
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
					<table style="width: 100%;border-collapse:collapse; font-size: 6;" border="1">
						<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid black; border-bottom: 1px solid black;" align="center" id="cetak_dimensi2"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_volumetrik2"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_berat2"></td>
						</tr>
					</table>
				</td>
				</tr>
						<tr>
					<td>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_kirim2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Packing</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_packing2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Asuransi</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_asu2"></td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b id="cetak_total2"></b>
							</td>
						</tr>
					</table>
					</td>
				</tr>
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 8;padding-left: 10px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol>
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
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<!-- ================================================= -->
	<hr>
	<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%">
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35%;font-size: 10; " align="right"><b id="cetak_resi3"></b></p> 
								 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Laut</p> 
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
							<td style="font-size: 10;" id="cetak_jumlah_barang3"></td>
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
					<table style="width: 100%;border-collapse:collapse; font-size: 6;" border="1">
						<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid black; border-bottom: 1px solid black;" align="center" id="cetak_dimensi3"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_volumetrik3"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_berat3"></td>
						</tr>
					</table>
				</td>
				</tr>
						<tr>
					<td>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;">-</td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Packing</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;">-</td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Asuransi</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;">-</td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b>-</b>
							</td>
						</tr>
					</table>
					</td>
				</tr>
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 8;padding-left: 10px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol>
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
	<!-- ================================================= -->
	<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center">
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35%;font-size: 10; " align="right"><b id="cetak_resi4"></b></p> 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Laut</p> 
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
							<td style="font-size: 10;" id="cetak_jumlah_barang4"></td>
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
					<table style="width: 100%;border-collapse:collapse; font-size: 6;" border="1">
						<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid black; border-bottom: 1px solid black;" align="center" id="cetak_dimensi4"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_volumetrik4"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_berat4"></td>
						</tr>
					</table>
				</td>
				</tr>
						<tr>
					<td>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;">-</td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Packing</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;">-</td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Asuransi</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;">-</td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b>-</b>
							</td>
						</tr>
					</table>
					</td>
				</tr>
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 8;padding-left: 10px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol>
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
	<hr>
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
<script src="{{asset('assets/js/resilaut.js')}}"></script>
<script type="text/javascript">
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      function isNumberKey2(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</script>
@endsection