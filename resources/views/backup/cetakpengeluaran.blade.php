@if(Session::get('level') == 'admin')
<script type="text/javascript">
    window.location.href = '{{url("/dashboard")}}';
</script>
@endif
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Pengeluaran Vendor Bulan {{$bulan}} Tahun {{$tahun}}</title>
</head>
<body onload="window.print()">
	<h3 align="center">
	Pengeluaran Vendor Bulan {{$bulan}} Tahun {{$tahun}}
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
			<tr>
							<th>No</th>
							<th>Kode</th>
							<th>No.Resi</th>
							<th>Tanggal Bayar</th>
							<th>vendor</th>
							<th>admin</th>
							<th>Subtotal</th>
						</tr>
		</tr>
		<?php $no=1;?>
		@foreach($data as $row)
		 <tr>
                            <td align="center">{{$no++}}</td>
                            <td align="center">{{$row->kode}}</td>
                            <td align="center">{{$row->no_resi}}</td>
                            <td align="center">{{$row->tgl_bayar}}</td>
                           	<td align="center">
                           		 <?php $vendor=explode('-',$row->tujuan);?>
								 	{{$vendor[0]}}
                           	</td>
                        	<td align="center">{{$row->admin}}</td>
                           <td align="center">{{"Rp ".number_format($row->biaya_suratjalan,0,',','.')}}</td>
                          
						</tr>
		@endforeach
	</table>
</body>
</html>