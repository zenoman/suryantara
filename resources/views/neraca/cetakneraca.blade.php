<!DOCTYPE html>
<html>
<head>
	<title>Print Laba Rugi Tahun {{$thn}}</title>
</head>
<body onload="window.print()">
		<table style="width: 100%">
			<tr>
				<td colspan="2" align="center">
					<b>
						@foreach($title as $row)
						<b style="font-size: 25px;">{{$row->namaweb}}</b>
						@endforeach
						<br>
						Laba Rugi
						<br> January 2019
					</b>
				</td>
			</tr>
			<!-- <tr>
				<td>
					Tanggal Cetak : {{date('d-m-Y')}}	
				</td>
				<td align="right">
					Pencetak : {{Session::get('username')}}
				</td>

			</tr> -->
		</table>
		<table border="0" style="width: 100%">
		<tr>
				<td style="padding: 5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	            <td></td>
	            <td align="center">IDR</td>
	            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	            </tr>
	            
			@foreach($data as $row)
								<tr>
									<td style="padding: 5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                                <td>{{$row->kategori}}</td>
	                                <td align="center">{{"Rp ".number_format($row->total,0,',','.')}}</td>
	                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                            </tr>
	           @endforeach

	                @foreach($hitd as $row)
	                <tr>
	                	<td  style="padding: 10px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                    <td><b><i>Total</i></b></font></td>
	                    <td align="center"><b>{{"Rp ".number_format($row->tot,0,',','.')}}</b></td>
	                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                    </tr>
	                   @endforeach
	                
	            @foreach($modal as $row)
	            <tr>
	            	<td style="padding: 5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                <td>{{$row->kategori}}</td>
	                <td align="center">{{"Rp ".number_format($row->total,0,',','.')}}</td>
	                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                </tr>
	                @endforeach
	            @foreach($data0 as $row)
	            @foreach($modal as $ro)
	            <tr>
	            	<td style="padding: 5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                <td>{{$row->tahun}}</td>
	                <td align="center">{{"Rp ".number_format($row->total - $ro->total,0,',','.')}}</td>
	                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                </tr>
	            @endforeach
	            @endforeach






	            
	                    @foreach($data0 as $row)
	                    <tr>
	                    	<td style="padding: 10px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                        <td><b><i>Total</i></b></font></td>
	                        <td align="center"><b>{{"Rp ".number_format($row->total,0,',','.')}}</b></td>
	                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                        </tr>
	                        @endforeach
	                @foreach($tot as $row)
					<tr>
						<td  style="padding: 10px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                    <td><b><i>Neraca</i></b></font></td>
	                    <td align="center" ><b>{{"Rp ".number_format($row->tot,0,',','.')}}</b></td>
	                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                    </tr>
	                @endforeach
					</table>
</body>
</html>