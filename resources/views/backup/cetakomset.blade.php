@if(Session::get('level') == 'admin')
<script type="text/javascript">
    window.location.href = '{{url("/dashboard")}}';
</script>
@endif
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
			<td>
				{{"Rp ".number_format($row->pemasukan,0,',','.')}}
			</td>
			<td>
				{{"Rp ".number_format($row->pengeluaran,0,',','.')}}
			</td>
			<td>
				{{"Rp ".number_format($row->pengeluaran_lainya,0,',','.')}}
			</td>
			<td>{{"Rp ".number_format($row->laba,0,',','.')}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>