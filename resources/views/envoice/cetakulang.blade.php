<!DOCTYPE html>
<html>
<head>
	<title>cetak envoice ulang</title>
</head>
<body onload="window.print();window.close();">
	@foreach($dataenvoice as $envo)
	<div id="hidden_div">

	<table width="100%">
		<tr>
			<td width="20%" align="center">
				<img src="{{asset('img/LOGO1.png')}}" alt="" width="70%">
			</td>
			<td width="60%">
				<h2 align="center">
		ENVOICE
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
			<td id="cetak_kodesj">: {{$envo->kode}}</td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: {{$envo->tgl}}</td>
		</tr>
		<tr>
			<td>Kepada Yth</td>
			<td id="cetak_tujuan">
				: {{$envo->tujuan}}
			</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td id="cetak_alamat">: {{$envo->alamat}}</td>
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
			<?php $i=1;?>
			@foreach($dataresi as $resi)
			<tr>
				<td>{{$i++}}</td>
				<td>{{$resi->no_resi}}</td>
				<td>{{$resi->no_smu}}</td>
				<td>{{$resi->nama_pengirim}}</td>
				<td>{{$resi->nama_penerima}}</td>
				<td>{{$resi->kode_tujuan}}</td>
				<td>{{$resi->nama_barang}}</td>
				<td align="center">{{$resi->jumlah}}</td>
				<td align="center">{{$resi->berat}}</td>
				<td align="center">{{"Rp ". number_format($resi->total_biaya,0,',','.')}}</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
		<tr>
			<td colspan="7" align="right"><b>Total</b></td>
			<td id="cetak_subtotaljumlah" align="center">{{$envo->totalkg}}</td>
			<td id="cetak_subtotalberat" align="center">{{$envo->totalkoli}}</td>
			<td id="cetak_totalcashnya" align="center">{{"Rp ". number_format($envo->totalcash,0,',','.')}}</td>
			
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
@endforeach
</body>
</html>
