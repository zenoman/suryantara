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
			<td>No Envoice</td>
			<td id="cetak_kodesj"></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>:&nbsp;{{date('d-m-Y')}}</td>
		</tr>
		<tr>
			<td>Kepada Yth</td>
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
			<td rowspan="2">Isi Paket</td>
			<td colspan="2">Jumlah</td>
			<td rowspan="2"> Biaya</td>
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
			<td colspan="7" align="right"><b>Total</b></td>
			<td id="cetak_subtotaljumlah" align="center"></td>
			<td id="cetak_subtotalberat" align="center"></td>
			<td id="cetak_totalcashnya" align="center"></td>
			
		</tr>
		
		</tfoot>
	</table>
	<br>
	<table width="100%;">
		<tr align="center">
			<td width="30%">
				{{Session::get('norek')}}
			</td>
			<td width="40%">
				
			</td>
			<td width="30%">
				<p>ADMIN CABANG</p>
				<br>
				<p>............</p>
			</td>
		</tr>
	</table>
</div>