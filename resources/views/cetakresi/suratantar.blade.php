<div id="hidden_div" style="display: none;">

	<table width="100%">
		<tr>
			<td width="20%" align="center">
				<img src="{{asset('img/LOGO1.png')}}" alt="" width="70%">
			</td>
			<td width="60%">
				<h2 align="center">
		MANIFEST ANTAR
		<br>	
		<span style="font-size: 18;margin-bottom: 20px;">PT. KADIRI LOGISTIK CARGO</span>
		<br>	
		<span style="font-size: 15;">{{Session::get('kop')}}</span>
	</h2>
			</td>
			<td width="20%"></td>
		</tr>
	</table>
	<table>
		<tr>
			<td>No</td>
			<td id="cetak_kodesj"></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>:&nbsp;{{date('d-m-Y')}}</td>
		</tr>
		<tr>
			<td>Kode Karyawan</td>
			<td id="cetak_kodekar"></td>
		</tr>
		<tr>
			<td>Pemegang</td>
			<td id="cetak_namakar"></td>
		</tr>
		<tr>
			<td>Telp</td>
			<td id="cetak_telpkar"></td>
		</tr>
	</table>
	<table border="1" width="100%;" style="border-collapse:collapse;border: 1px solid black;">
		<thead>
			<tr align="center">
			<td rowspan="2">No</td>
			<td rowspan="2">No. Resi</td>
			<td rowspan="2">No. SMU</td>
			<td rowspan="2">Pengirim</td>
			<td rowspan="2">Penerima</td>
			<td rowspan="2">Tujuan</td>
			<td colspan="2">Jumlah</td>
			<td rowspan="2">Isi Paket</td>
			
		</tr>
		<tr align="center">
			<td>Koli</td>
			<td>Kg</td>
			
			
		</tr>
		</thead>
		
		<tbody id="list_cetak">
			
		</tbody>
		<tfoot>
		<tr>
			<td colspan="6" align="right"><b>Total</b></td>
			<td id="cetak_subtotaljumlah" align="center"></td>
			<td id="cetak_subtotalberat" align="center"></td>
			<td></td>
			
		</tr>
		
		</tfoot>
	</table>
	<br>
	<table width="100%;">
		<tr align="center">
			<td>
				<p>Diserahkan Oleh</p>
				<br>
				<p>oprasional cabang</p>
			</td>
			<td>
				
			</td>
			<td>
				<p>Diterima Oleh</p>
				<br>
				<p id="cetak_ttdnama"></p>
			</td>
		</tr>
	</table>
</div>