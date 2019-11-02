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
					{{Session::get('kop')}}
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35%;font-size: 10; " align="right"><b id="cetak_resi"></b></p> 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Darat</p> 
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
							<td style="font-size: 11;" >
								<b>
									<span id="cetak_metode"></span>
								</b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Asal&nbsp;:&nbsp;</td>
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
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal">
									{{Session::get('kota')}}, <?php echo date('d-m-Y');?>
								</p>
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
					{{Session::get('kop')}}
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35%;font-size: 10; " align="right"><b id="cetak_resi2"> 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Darat</p> 
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
							<td style="font-size: 11;">
								<b><span  id="cetak_metode2">
									
								</span></b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b><span id="cetak_kota_asal2" ></span></b>
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
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal2">
									{{Session::get('kota')}}, <?php echo date('d-m-Y');?>
								</p>
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
				<td style="width: 50%" align="center">
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					{{Session::get('kop')}}
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35%;font-size: 10; " align="right"><b id="cetak_resi3"> 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Darat</p> 
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
							<td style="font-size: 11;">
								<b><span id="cetak_metode3">
									
								</span></b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_asal3">
												</span>
											</b>
										</td>
										<td style="font-size: 11;">Tujuan&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_tujuan3">
												</span>
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
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal3">
									{{Session::get('kota')}}, <?php echo date('d-m-Y');?>
								</p>
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
					{{Session::get('kop')}}
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35%;font-size: 10; " align="right"><b id="cetak_resi4"> 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Darat</p> 
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
							<td style="font-size: 11;" >
								<b><span id="cetak_metode4">
									
								</span></b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
											<span  id="cetak_kota_asal4">
											</span>	
											</b>
											
										</td>
										<td style="font-size: 11;">Tujuan&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_tujuan4"> </span>
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
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal4">
									{{Session::get('kota')}}, <?php echo date('d-m-Y');?>
								</p>
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