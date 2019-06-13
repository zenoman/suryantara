<!DOCTYPE html>
<html>
<head>
	<title>Cetak Absensi Tanggal {{$tgl}}</title>
</head>
<body onload="window.print()">
		<table style="width: 100%">
			<tr>
				<td colspan="2" align="center">
					<b>
						Absensi pada bulan {{$tgl}}
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
							<th>Kode Karyawan</th>
							<th>Nama Karyawan</th>
							<th>Jabatan</th>
							<th>Masuk</th> 
							<th>Izin</th>
							<th>Tidak Masuk</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->kode}}</td>
                            <td>{{$row->nama}}</td>
                            <td>{{$row->jabatan}}</td>
							<td>{{$row->masuk}}</td>
							<td>{{$row->izin}}</td>
							<td>{{$row->tidak_masuk}}</td>
                        </tr>
						@endforeach
						
						</tbody>
					</table>
</body>
</html>