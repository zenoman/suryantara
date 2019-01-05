<!DOCTYPE html>
<html>
<head>
	<title>Cetak Pendapatan Bulan {{$bulan}} Tahun {{$tahun}}</title>
</head>
<body onload="window.print()">
	<h3 align="center">
	Pendapatan Bulan {{$bulan}} Tahun {{$tahun}}
	</h3>
	<table style="width: 100%">
		<tr>
			<td align="left">
			Pencetak : {{Session::get('username')}}
			</td>
			<td align="right">
				Tanggal Cetak : {{date('d-m-Y')}}
			</td>
		</tr>
	</table>
	
	<table border="1" style="width: 100%">
		<tr>
			<td>tanggal</td>
           <td>nomor resi</td>
           <td>nomor smu</td>
           <td>nomor surat jalan</td>
           <td>pembuat</td>
           <td>isi paket</td>
           <td>jalur pengiriman</td>
           <td>kota asal</td>
           <td>kota tujuan</td>
           <td>jumlah</td>
           <td>berat (kg)</td>
           <td>dimensi (PxLxT)</td>
           <td>volumetrik</td>
           <td>pengirim</td>
           <td>telp. pengirim</td>
           <td>penerima</td>
           <td>telp. penerima</td>
           <td>biaya kirim</td>
           <td>biaya packing</td>
           <td>biaya asuransi</td>
           <td>biaya SMU</td>
           <td>biaya karantina</td>
           <td>biaya ppn</td>
           <td>total biaya</td>
           <td>metode bayar</td>
           <td>acuan bayar</td>
           <td>keterangan</td>
		</tr>
		@foreach($data as $row)
		<tr>
			<td>{{$row->tgl}}</td>
			<td>{{$row->no_resi}}</td>
			<td>{{$row->no_smu}}</td>
			<td>{{$row->kode_jalan}}</td>
			<td>{{$row->admin}}</td>
			<td>{{$row->nama_barang}}</td>
			<td>{{$row->pengiriman_via}}</td>
			<td>{{$row->kota_asal}}</td>
			<td>{{$row->kode_tujuan}}</td>
			<td>{{$row->jumlah}}</td>
			<td>{{$row->berat}}</td>
			<td>{{$row->dimensi}}</td>
			<td>{{$row->ukuran_volume}}</td>
			<td>{{$row->nama_pengirim}}</td>
			<td>{{$row->telp_pengirim}}</td>
			<td>{{$row->nama_penerima}}</td>
			<td>{{$row->telp_penerima}}</td>
			<td>{{$row->biaya_kirim}}</td>
			<td>{{$row->biaya_packing}}</td>
			<td>{{$row->biaya_asuransi}}</td>
			<td>{{$row->biaya_smu}}</td>
			<td>{{$row->biaya_karantina}}</td>
			<td>{{$row->biaya_ppn}}</td>
			<td>{{$row->total_biaya}}</td>
			<td>{{$row->metode_bayar}}</td>
			<td>{{$row->satuan}}</td>
			<td>{{$row->keterangan}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>