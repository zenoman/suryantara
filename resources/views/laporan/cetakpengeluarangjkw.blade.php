<!DOCTYPE html>
<html>
<head>
	<title>Cetak Pemasukan Bulan {{$bulanya}} Tahun {{$tahunya}}</title>
</head>
<body onload="window.print()">
		<table style="width: 100%">
			<tr>
				<td colspan="2" align="center">
					<b>
						@if($jabatan == 'semua')
						Laporan Pengeluaran Gaji Karyawan Bulan {{$bulanya}} Tahun {{$tahunya}}
						@else
						Laporan Pengeluaran Gaji {{$jabatan}} Bulan {{$bulanya}} Tahun {{$tahunya}}
						@endif
						
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
							<th>Gaji Pokok</th>
							<th>Uang Makan</th>
							<th>Tambahan</th>
							<th>Total</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $i = 1;?>
                            @foreach($data2 as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->kode_karyawan}}</td>
                            <td>{{$row->nama_karyawan}}</td>
                            <td>{{$row->jabatan}}</td>
							<td>{{"Rp ".number_format($row->gaji_pokok,0,',','.')}}</td>
							<td>{{"Rp ".number_format($row->uang_makan,0,',','.')}}</td>
							
							<td>{{"Rp ".number_format($row->gaji_tambahan,0,',','.')}}</td>
							<td>{{"Rp ".number_format($row->total,0,',','.')}}</td>
                        </tr>
						@endforeach
						
						</tbody>
					</table>
					@foreach($total as $ttl)
					<p>Total : <b>{{"Rp. ".number_format($ttl->totalnya,0,',','.')}}</b></p>
					@endforeach
</body>
</html>