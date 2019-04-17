<!DOCTYPE html>
<html>
<head>
	<title>Cetak Pengeluaran Bulan {{$bulan}} Tahun {{$tahun}}</title>
</head>
<body onload="window.print()">
		<table style="width: 100%">
			<tr>
				<td colspan="2" align="center">
					<b>
						@if($haribulan == 'harian')
						@if($vendor=='semua')
						Laporan Pengeluaran Tanggal {{$bulanya}}
						@else
						Laporan Pengeluaran {{$vendor}} Tanggal {{$bulanya}}
						@endif
						@else
						@if($vendor=='semua')
						Laporan Pengeluaran Bulan {{$bulan}}-{{$tahun}}
						@else
						Laporan Pengeluaran {{$vendor}} Bulan {{$bulan}}-{{$tahun}}
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
							<th>Kode</th>
							<th>No.Resi</th>
							<th>Tanggal Bayar</th>
								@if($vendor=='semua')
									<th>vendor</th>
								@endif
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
                            <td align="center">{{$row->kode}}</td>
                            <td align="center">{{$row->no_resi}}</td>
                            <td align="center">{{$row->tgl_bayar}}</td>
                            	@if($vendor=='semua')
								 <td align="center">
								 <?php $vendor=explode('-',$row->tujuan);?>
								 	{{$vendor[0]}}
								 </td>
                            	@endif
                            <td align="center">{{$row->admin}}</td>
                           
							<td align="center">{{"Rp ".number_format($row->biaya_suratjalan,0,',','.')}}</td>
                          
						</tr>
						@endforeach
						
						</tbody>
					</table>
					@foreach($total as $ttl)
					<p>Total : <b>{{"Rp. ".number_format($ttl->totalnya,0,',','.')}}</b></p>
					@endforeach
</body>
</html>