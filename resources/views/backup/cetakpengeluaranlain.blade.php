<!DOCTYPE html>
<html>
<head>
	<title>Cetak Pengeluaran Lain Bulan {{$bulan}} Tahun {{$tahun}}</title>
</head>
<body onload="window.print()">
	<h3 align="center">
	Pendapatan Pengeluaran Lain Bulan {{$bulan}} Tahun {{$tahun}}
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
            <td>Kategori Pengeluaran</td>
            <td>Jumlah</td>
            <td>Keterangan</td>
            <td>Pembuat</td>
		</tr>
		@foreach($data as $row)
		<tr>
			<td>{{$row->tgl}}</td>
			<td>{{$row->kategori}}</td>
			<td>{{$row->jumlah}}</td>
			<td>{{$row->keterangan}}</td>
			<td>{{$row->admin}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>