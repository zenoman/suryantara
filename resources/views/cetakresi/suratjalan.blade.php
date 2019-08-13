<div id="hidden_div" style="display: none;">

	<table width="100%">
		<tr>
			<td width="20%" align="center">
				<img src="{{asset('img/LOGO1.png')}}" alt="" width="70%">
			</td>
			<td width="60%">
				<h2 align="center">
		SURAT JALAN
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
			<td>Tujuan</td>
			<td id="cetak_tujuan"></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td id="cetak_alamat"></td>
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
			<td colspan="2"> Biaya</td>
			<td rowspan="2">Ket</td>
		</tr>
		<tr align="center">
			<td>Koli</td>
			<td>Kg</td>
			<td>Cash</td>
			<td>BT</td>
			
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
			<td></td>
			<td></td>
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
				<p>Koordinator Cabang Asal</p>
			</td>
			<td>
				<p>Diantar Oleh</p>
				<br>
				<p>Sopir</p>
			</td>
			<td>
				<p>Diterima Oleh</p>
				<br>
				<p>Koordinator Cabang Tujuan</p>
			</td>
		</tr>
	</table>
</div>
<div id="hidden_divcabang" style="display: none;">
	
	<table width="100%">
		<tr>
			<td width="20%" align="center">
				<img src="{{asset('img/LOGO1.png')}}" alt="" width="70%">
			</td>
			<td width="60%">
				<h2 align="center">
		SURAT JALAN
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
			<td id="cetak_kodesj2"></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>:&nbsp;{{date('d-m-Y')}}</td>
		</tr>
		<tr>
			<td>Tujuan</td>
			<td id="cetak_tujuan2"></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td id="cetak_alamat2"></td>
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
			<td colspan="2"> Biaya</td>
			<td rowspan="2">Ket</td>
		</tr>
		<tr align="center">
			<td>Koli</td>
			<td>Kg</td>
			<td>Cash</td>
			<td>BT</td>
			
		</tr>
		</thead>
		
		<tbody  id="list_cetak2">
			
		</tbody>
		<tfoot>
		<tr>
			<td colspan="6" align="right"><b>Total</b></td>
			<td id="cetak_subtotaljumlah2" align="center"></td>
			<td id="cetak_subtotalberat2" align="center"></td>
			<td></td>
			<td id="cetak_totalcashnya"></td>
			<td id="cetak_totalbtnya"></td>
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
				<p>Koordinat Cabang Asal</p>
			</td>
			<td>
				<p>Diantar Oleh</p>
				<br>
				<p>Sopir</p>
			</td>
			<td>
				<p>Diterima Oleh</p>
				<br>
				<p>Koordinat Cabang Tujuan</p>
			</td>
		</tr>
	</table>
</div>