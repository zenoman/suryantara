<!DOCTYPE html>
<html>
<head>
	<title>@foreach($kat as $row)Cetak {{$row->nama}} Tanggal {{$tgl}} Sampai {{$tgl0}}@endforeach</title>
</head>
<body onload="window.print()">
		<table style="width: 100%">
			<tr>
				<td colspan="2" align="center">
					<b>
						@foreach($kat as $row)
						{{$row->nama}} Tanggal {{$tgl}} Sampai {{$tgl0}}
						@endforeach
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
							<th>Admin</th>
							<th>Kategori</th>
							<th>tgl</th>
							<th>Subtotal</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $i = 1; $j = 0;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                            <?php $n = $j++;?>
                            @foreach($tot[$n] as $ros)
                        <tr>
                            <td align="center">{{$no}}</td>
							<td align="center">{{$row->admin}}</td>
                            <td align="center">{{$row->nama}}</td>
                            @if($kat=='Pajak')
                            <td align="center">{{$row->bulan}}-{{$row->tahun}}</td>
                            @else
                            <td align="center">{{$row->tgl}}</td>
                            @endif
							<td align="center">{{"Rp ".number_format($ros->totalnya,0,',','.')}}</td>
                          
						</tr>
						@endforeach
						@endforeach
						
						</tbody>
					</table>
					@foreach($tose as $ttl)
					<p>Total : <b>{{"Rp ".number_format($ttl->totalnya,0,',','.')}}</b></p>
					@endforeach
</body>
</html>