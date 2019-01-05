<!DOCTYPE html>
<html>
<head>
	<title>Cetak Pengeluaran Vendor Bulan {{$bulan}} Tahun {{$tahun}}</title>
</head>
<body onload="window.print()">
	<h3 align="center">
	Pendapatan Pengeluaran Vendor Bulan {{$bulan}} Tahun {{$tahun}}
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
			<td>Tanggal</td>
            <td>Nomor surat jalan</td>
            <td>Tujuan</td>
            <td>Total berat(Kg)</td>
            <td>Total jumlah(Koli)</td>
            <td>Total Cash</td>
            <td>Total BT</td>
            <td>Biaya</td>
            <td>Alamat tujuan</td>
            <td>Pembuat</td>
		</tr>
		@foreach($data as $row)
		<tr>
			<td>{{$row->tgl}}</td>
			<td>{{$row->kode}}</td>
			<td>{{$row->tujuan}}</td>
			<td>{{$row->totalkg}}</td>
			<td>{{$row->totalkoli}}</td>
			<td>{{$row->totalcash}}</td>
			<td>{{$row->totalbt}}</td>
			<td>{{$row->biaya}}</td>
			<td>{{$row->alamat_tujuan}}</td>
			<td>{{$row->admin}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>