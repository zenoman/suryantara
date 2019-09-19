<!DOCTYPE html>
<html>
<head>
	<title>Cetak Rekap Gaji Bulan {{$bul1}} Sampai {{$bul2}}</title>
	<link rel="stylesheet" href="{{asset('assets/css/lib/bootstrap/bootstrap.min.css')}}">	
</head>
<body>
<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center" >
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					{{Session::get('kop')}}
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">								
				</td>
			</tr>
		</table>
	</div>
    <hr>
		<table style="width: 100%" border="0">
			<tr>
				<td colspan="2" align="center">
					<b>
					    Rekap Gaji Karyawan Tanggal {{$bul1}} Sampai {{$bul2}}
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
		<table border="1" id="example"  class="display table table-striped table-bordered" cellspacing="0">
						<thead>
						<tr>
                            <th>No</th>
                            <th>Karyawan</th>                                
                            <th>Gaji Pokok</th>
                            <th>Uang Makan</th>
                            <th>Bonus</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Total</th>
						</tr>
						</thead>						
						<tbody>
                            <?php $nomer = 1;?>
                            @foreach($lap as $row)
                            <tr>
                                <td>{{$nomer++}}</td>
                                <td>{{$row->nama_karyawan}}</td>                                
                                <td>Rp. {{number_format($row->gaji_pokok)}}</td>   
                                @if ($row->uang_makan==null)
                                <td>-</td>
                                @else
                                <td>Rp. {{number_format($row->uang_makan)}}</td>    
                                @endif                        
                                @if ($row->gaji_tambahan==null)
                                <td>-</td>
                                @else
                                <td>Rp. {{number_format($row->gaji_tambahan)}}</td>    
                                @endif    
                                <td>{{$row->bulan}}</td>
                                <td>{{$row->tahun}}</td>
                                <td>Rp. {{number_format($row->total)}}</td>
                                <td class="tdtot">{{$row->total}}</td>
                            </tr>
                        @endforeach					
						</tbody>
					</table>
					<div class="row">
							<div class="col col-xl-12 dashboard-col">
								<h4 class="text-right"><b>Total Rp. <span id="toata"></span></b></h4>
							</div> 
					</div>
					
</body>

<script src="{{asset('assets/js/lib/jquery/jquery-3.2.1.min.js')}}"></script>
<script>	
$(document).ready(function(){
	$('.tdtot').hide();
        window.print();
        })
        window.onafterprint = function() {
            history.go(-1);
        };
	// Count Total
	
		// Call Sum
		function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}
		var table=document.getElementById('example'),sumval=0;
		for(var i=1;i<table.rows.length;i++){
			// sumval=sumval+parseInt(table.rows[i].cells[5].innerHTML);
			sumval=sumval+parseInt(table.rows[i].cells[8].innerHTML);
		}
		$('#toata').html(numberWithCommas(sumval));
</script>
</html>