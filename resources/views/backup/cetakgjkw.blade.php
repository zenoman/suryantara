@if(Session::get('level') == 'admin')
<script type="text/javascript">
    window.location.href = '{{url("/dashboard")}}';
</script>
@endif
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Gaji Karyawan Bulan {{$bulan}} Tahun {{$tahun}}</title>
</head>
<body onload="window.print()">
	<h3 align="center">
	Pendapatan Gaji Karyawan Bulan {{$bulan}} Tahun {{$tahun}}
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
			<td><b>Bulan</b></td>
            <td><b>Tahun</b></td>
			<td><b>Kode Karyawan</b></td>
            <td><b>Nama Karyawan</b></td>
            <td><b>Jabatan</b></td>
            <td><b>Gaji Pokok</b></td>
            <td><b>Uang Makan</b></td>
            <td><b>Gaji Tambahan</b></td>
            <td><b>Total</b></td>
		</tr>
		@foreach($data as $row)
	<tr>
			<td>{{$row->bulan}}</td>
			<td>{{$row->tahun}}</td>
			<td>{{$row->kode_karyawan}}</td>
			<td>{{$row->nama_karyawan}}</td>
			<td>{{$row->jabatan}}</td>
			<td>
				{{"Rp ".number_format($row->gaji_pokok,0,',','.')}}
			</td>
			<td>
				{{"Rp ".number_format($row->uang_makan,0,',','.')}}
			</td>
			<td>
				{{"Rp ".number_format($row->gaji_tambahan,0,',','.')}}
			</td>
			<td>{{"Rp ".number_format($row->total,0,',','.')}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>