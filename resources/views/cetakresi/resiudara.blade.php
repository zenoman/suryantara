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
								<p style="margin-left: 35%;font-size: 10; " align="right"><b id="cetak_resi"></b></p> 
								
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
								<p style="margin-left: 35%;font-size: 10; " align="right"><b id="cetak_resi2"></b></p> 
								
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
										<td style="font-size: 11;">Asal&nbsp;:&nbsp;</td>
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
								<p style="margin-left: 35%;font-size: 10; " align="right"><b id="cetak_resi3"></b></p> 
								 
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
										<td style="font-size: 11;">Asal&nbsp;:&nbsp;</td>
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
								<p style="margin-left: 35%;font-size: 10; " align="right"><b id="cetak_resi4"></b></p> 
								
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
										<td style="font-size: 11;">Asal&nbsp;:&nbsp;</td>
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
	<div id="hidden_div_pti" style="display: none;">
	<div>
		<table style="width: 100%;" border="0">
				<tr>
					<td style="width: 25%" align="center">
						<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">

					</td>
					<td><hr style="width: 1px;height:80px;color: black;"></td>
					<td style="width: 75%;padding-left:10px;" align="left" >
					<p style="font-size:10;">
						<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
						Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
						Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
					</p>
					</td>
					
				</tr>
		</table>
		<hr width="90%">	
	</div>
	<div>
		<table style="width:100%;" border="0">
			<tr>
				<td align="center" colspan="3">
					<h3><b><u>KETERANGAN ISI KIRIMAN</u></b></h3>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="3">
					&emsp;&emsp;Yang bertanda tangan di bawah ini :
				</td>
			</tr>
			<tr>
				<td width="30%">
					&nbsp;Nama
				</td>
				<td width="3%" align="center">
					&nbsp;:&nbsp;
				</td>
				<td>
					KLC Cabang Kediri
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;Alamat
				</td>
				<td align="center">
					&nbsp;:&nbsp;
				</td>
				<td>
					Kediri
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;No Telpon
				</td>
				<td align="center">
					&nbsp;:&nbsp;
				</td>
				<td>
					081133378240
				</td>
			</tr>
			<tr>
				<td colspan="3" align="left">
					<p id="ket_pti">
						&emsp;&emsp;Menerangkan bahwa kiriman yang diserahkan untuk diangkut oleh .......................
					</p>
					
				</td>
			</tr>
			<tr>
				<td colspan="3" align="left">
					Yang dialamatkan kepada : 
				</td>
				
			</tr>
			<tr>
				<td>
					&nbsp;Nama
				</td>
				<td align="center">
					&nbsp;:&nbsp;
				</td>
				<td>
					<p id="cetak_pti_penerima"></p>
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;Alamat
				</td>
				<td align="center">
					&nbsp;:&nbsp;
				</td>
				<td>
					<p id="cetak_pti_alamatp"></p>
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;Dengan surat muatan udara no
				</td>
				<td align="center">
					&nbsp;:&nbsp;
				</td>
				<td>
					<p id="cetak_smu_pti"></p>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<p>
						&emsp;&emsp;Berisi barang-barang seperti berikut :
					</p>
					
				</td>
			</tr>
		</table>

	</div>
	<div align="center">
		<table width="95%" border="1">
			<thead>
			<tr>
				<td width="10%" align="center"><b>Jumlah</b></td>
				<td width="10%" align="center"><b>Satuan</b></td>
				<td width="40%" align="center"><b>Penjelasan isi barang</b></td>
				<td width="20%" align="center"><b>Ukuran Volume</b></td>
				<td width="10%" align="center"><b>Berat Volume</b></td>
				<td width="10%" align="center"><b>Berat Kg</b></td>
			</tr>
			</thead>
			<tbody id="listpti">
				
			</tbody>
			
			<tr>
				<td colspan="4" align="right">
					<b>Jumlah Berat</b>&nbsp;&nbsp;
				</td>
				<td align="center">
					<b id="berat_volume_pti"></b>
				</td>
				<td align="center">
					<b id="berat_total_pti"></b>
				</td>
			</tr>
		</table>
	</div>
	<p style="font-size:11;">
		Selain dari itu, pengirim menerangkan dan mengetahui bahwa pengisian keterangan isi kiriman dengan tidak benak, dapat dihukum dengan denda dan atau pensitaan atas kiriman itu. <br>
		Pengirim menerangkan pula bahwa ia bersedia sewaktu-waktu membayar ganti rugi yang disebabkan karena keterangan isi kiriman telah diisi tidak dengan sebenarnya.
	</p>
	<br>
	<div align="center">
		<table width="100%" border="0">
			
			<tr>
				<td width="80%" align="center"><b></b></td>
				<td width="40%" align="center"><b>Kediri, <?php echo date('d-m-y')?></b></td>
				
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td></td>
				<td align="center">............................................ 
					<br> 
				(Tanda Tangan & Nama Terang)</td>
				
			</tr>
		</table>
	</div>
</div>