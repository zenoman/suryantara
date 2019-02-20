<!DOCTYPE html>
<html>
<head>
	<title>Cetak Pajak Tahun {{$tahunya}}</title>
</head>
<body onload="window.print()">
		<table style="width: 100%">
			<tr>
				<td colspan="2" align="center">
					<b>
						@if($tahunya=='semua')
						Laporan Pajak
						@else
						Laporan Pajak Tahun {{$tahunya}}
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
							@if($tahunya=='semua')
								<th>bulan</th>
							@endif
							<th>tahun</th>
							<th>Subtotal</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            @if($tahunya=='semua')
                            <td>{{$row->bulan}}</td>
                            @endif
                            <td>{{$row->tahun}}</td>
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