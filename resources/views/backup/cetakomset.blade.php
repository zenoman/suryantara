<!DOCTYPE html>
<html>
<head>
	<title>Cetak Omset Bulan {{$bulan}} Tahun {{$tahun}}</title>
</head>
<body onload="window.print()">
	<h3 align="center">
	Pendapatan Omset Bulan {{$bulan}} Tahun {{$tahun}}
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
			<td>Bulan</td>
            <td>Tahun</td>
            <td>Pemasukan</td>
            <td>Pengeluaran Vendor</td>
            <td>Pengeluaran Lainya</td>
            <td>Laba</td>
		</tr>
		@foreach($data as $row)
		<tr>
			<td>{{$row->bulan}}</td>
			<td>{{$row->tahun}}</td>
			<td>{{$row->pemasukan}}</td>
			<td>{{$row->pengeluaran}}</td>
			<td>{{$row->pengeluaran_lainya}}</td>
			<td>{{$row->laba}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>