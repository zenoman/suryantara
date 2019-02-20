<!DOCTYPE html>
<html>
<head>
	<title>Cetak Pemasukan Bulan {{$bulan}} Tahun {{$tahun}}</title>
</head>
<body onload="window.print()">
		<table style="width: 100%">
			<tr>
				<td colspan="2" align="center">
					<b>
						@if($jalur=='semua')
						Laporan Pemasukan Bulan {{$bulan}}-{{$tahun}}
						@else
						Laporan Pemasukan {{$jalur}} Bulan {{$bulan}}-{{$tahun}}
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
							<th>No resi</th>
							<th>tanggal</th>
							<th>Tujuan</th>
								@if($jalur=='semua')
									<th>jalur</th>
								@endif
							<th>pengirim</th>
							<th>penerima</th>
							<th>admin</th>
							<th>Subtotal</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $i = 1;?>
                            @foreach($data2 as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td align="center">{{$no}}</td>
                            <td align="center">{{$row->no_resi}}</td>
                            <td align="center">{{$row->tgl}}</td>
                            <td align="center">{{$row->kota_asal}}-{{$row->kode_tujuan}}</td>
                            	@if($jalur=='semua')
								 <td>{{$row->pengiriman_via}}</td>
                            @endif
                            <td align="center">{{$row->nama_pengirim}}</td>
                            <td align="center">{{$row->nama_penerima}}</td>
							<td align="center">{{$row->admin}}</td>
							<td align="center">{{"Rp ".number_format($row->total_biaya,0,',','.')}}</td>
                          
						</tr>
						@endforeach
						
						</tbody>
					</table>
					@foreach($total as $ttl)
					<p>Total : <b>{{"Rp. ".number_format($ttl->totalnya,0,',','.')}}</b></p>
					@endforeach
</body>
</html>