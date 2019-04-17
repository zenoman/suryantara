<!DOCTYPE html>
<html>
<head>
	<title>Cetak Pengeluaran Lain Bulan {{$bulan}} Tahun {{$tahun}}</title>
</head>
<body onload="window.print()">
<table style="width: 100%">
			<tr>
				<td colspan="2" align="center">
					<b>
					@if($haribulan == 'harian')
						@if($kategori=='semua')
						Laporan Pengeluaran tanggal {{$bulanya}}
						@else
						Laporan Pengeluaran {{$kategori}} tanggal {{$bulanya}}
						@endif
					@else
						@if($kategori=='semua')
						Laporan Pengeluaran Bulan {{$bulanya}}
						@else
						Laporan Pengeluaran {{$kategori}} Bulan {{$bulanya}}
						@endif
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
							<th>tanggal</th>
							@if($kategori=='semua')
									<th>Kategori</th>
							@endif
							<th>Jumlah</th>
							<th>Pembuat</th>
							<th>Keterangan</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $nomer = 1;?>
                            @foreach($data2 as $row)
                            <tr>
							<td align="center">{{$nomer++}}</td>
							<td align="center">{{$row->tgl}}</td>
							@if($kategori=='semua')
							<td align="center">{{$row->kategori}}</td>
							@endif
							<td align="right">{{"Rp ".number_format($row->jumlah,0,',','.')}}</td>
							<td align="center">
								{{$row->admin}}
							</td>
							<td>
								{{$row->keterangan}}
							</td>
						</tr>
						@endforeach
						
						</tbody>
					</table>
					@foreach($total as $ttl)
					<p>Total : <b>{{"Rp. ".number_format($ttl->totalnya,0,',','.')}}</b></p>
					@endforeach
</body>
</html>