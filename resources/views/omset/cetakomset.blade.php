<!DOCTYPE html>
<html>
<head>
	<title>Cetak pmset Bulanan</title>
</head>
<body onload="window.print()">
		<table style="width: 100%">
			<tr>
				<td colspan="2" align="center">
					<b>
						Omset Bulanan
					</b>
				</td>
			</tr>
			<tr>
				<td>
					Tanggal Cetak : {{date('d-m-Y')}}	
				</td>
				<td align="right">
					Pencetak : {{Session::get('username')}}
				</td>

			</tr>
		</table>
		<table border="1" style="width: 100%">
						<thead>
						<tr> 
							<th>No</th>
							<th>Bulan</th>
							<th>Pemasukan</th>
							<th>Pengeluaran</th>
							<th>Pengeluaran Gaji karyawan</th>
							<th>Pengeluaran lainya</th>
							<th>Pajak</th>
							<th>Laba</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->bulan}}-{{$row->tahun}}</td>
                            <td>{{"Rp ".number_format($row->pemasukan,0,',','.')}}</td>
                            <td>{{"Rp ".number_format($row->pengeluaran,0,',','.')}}</td>
                            <td>{{"Rp ".number_format($row->gaji_karyawan,0,',','.')}}</td>
                            <td>{{"Rp ".number_format($row->pengeluaran_lainya,0,',','.')}}</td>
							<td>{{"Rp ".number_format($row->pajak,0,',','.')}}</td>
							<td>{{"Rp ".number_format($row->laba,0,',','.')}}</td>
                        </tr>
						@endforeach
						</tbody>
					</table>
</body>
</html>