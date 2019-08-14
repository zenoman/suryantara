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
	            <?php $j = 0;?>
	        @foreach($resi as $ro)
	            <?php $n = $j++;?>
			@foreach($totresi[$n] as $roz)
	                            <tr>
	                            	<td style="padding: 5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                                <td>{{$ro->nama}}</td>
	                                <td align="center">{{"Rp ".number_format($roz->toto,0,',','.')}}</td>
	                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                            </tr>
	        @endforeach
	        @endforeach

	                @foreach($totresithn as $roa)
	                <tr>
	                	<td  style="padding: 10px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                    <td><b><i>Total</i></b></font></td>
	                    <td align="center"><b>{{"Rp ".number_format($roa->toto,0,',','.')}}</b></td>
	                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                    </tr>
	                   @endforeach

	                <?php $k = 0;?>
	            @foreach($data as $row)
	             <?php $o = $k++;?>
	            @foreach($toto[$o] as $roz0)
	            <tr>
	            	<td style="padding: 5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                <td>{{$row->nama}}</td>
	                <td align="center">{{"Rp ".number_format($roz0->totalnya,0,',','.')}}</td>
	                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                </tr>
	                @endforeach
	                @endforeach

	            <!--    <?php $k = 0;?>-->
	            <!--@foreach($surat as $row)-->
	            <!--<?php $o = $k++;?>-->
	            <!--@foreach($totsurat[$o] as $roz0)-->
	            <!--                <tr>-->
	            <!--                	<td style="padding: 5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>-->
	            <!--                    <td>{{$row->nama}}</td>-->
	            <!--                    <td align="center">{{"Rp ".number_format($roz0->toto,0,',','.')}}</td>-->
	            <!--                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>-->
	            <!--                </tr>-->
	            <!--@endforeach-->
	            <!--@endforeach-->

	            <!--    <?php $k = 0;?>-->
	            <!--@foreach($pajak as $row)-->
	            <!--<?php $o = $k++;?>-->
	            <!--@foreach($totpajak[$o] as $roz0)-->
	            <!--                <tr>-->
	            <!--                	<td style="padding: 5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>-->
	            <!--                    <td>{{$row->nama}}</td>-->
	            <!--                    <td align="center">{{"Rp ".number_format($roz0->toto,0,',','.')}}</td>-->
	            <!--                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>-->
	            <!--                </tr>-->
	            <!--@endforeach-->
	            <!--@endforeach-->

	                    @foreach($tot as $ro)
	                    <tr>
	                    	<td style="padding: 10px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                        <td><b><i>Total</i></b></font></td>
	                        <td align="center"><b>{{"Rp ".number_format($ro->toto,0,',','.')}}</b></td>
	                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                        </tr>
	                        @endforeach

	                @foreach($totresithn as $rot)
					@foreach($tot as $ro)
					<tr>
						<td  style="padding: 10px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                    <td><b><i>Laba Rugi</i></b></font></td>
	                    <td align="center" ><b>{{"Rp ".number_format($rot->toto - $ro->toto,0,',','.')}}</b></td>
	                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                    </tr>
					@endforeach
					@endforeach
					</table>
</body>
</html>