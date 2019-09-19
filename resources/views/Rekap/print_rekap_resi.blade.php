<!DOCTYPE html>
<html>
<head>
	<title>Cetak {{$kat}} Akutansi Tanggal {{$bul1}} Sampai {{$bul2}}</title>
	<link rel="stylesheet" href="{{asset('assets/css/lib/bootstrap/bootstrap.min.css')}}">	
	<style>
		@page{
			size: landscape;
		}
	</style>
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
					    Rekap {{$kat}} Tanggal {{$bul1}} Sampai {{$bul2}}
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
                            <th>No Resi</th>                                
                            <th>Admin</th>
                            <th>Barang</th>
                            <th>Via</th>
                            <th>Kota Asal</th>
                            <th>Kota Tujuan</th>
                            <th>Tanggal Kirim</th>
                            <th>Pengirim</th>
							<th>Total Biaya</th>							
							<th>Pembayaran</th>
							<th>Total Kurang</th>
						</tr>
						</thead>						
						<tbody>
                            <?php $nomer = 1;?>
                            @foreach($lap as $row)
                            <tr>
                                <td>{{$nomer++}}</td>
                                <td>{{$row->no_resi}}</td>                                
                                <td>{{$row->admin}}</td>    
                                <td>{{$row->nama_barang}}</td>                           
                                <td>
                                    {{$row->pengiriman_via}}
                                </td>
                                <td>{{$row->kota_asal}}</td>
                                <td>{{$row->kode_tujuan}}</td>
                                <td>{{$row->tgl}}</td>
                                <td>{{$row->nama_pengirim}}</td>
                                <td>Rp. {{number_format($row->total_biaya)}}</td>
                                <td>Rp. {{number_format($row->total_bayar)}}</td>
                                <td>Rp. {{number_format($row->kurang)}}</td>
                                <td class="tdtot">{{$row->total_bayar}}</td>
                            </tr>
                        @endforeach					
						</tbody>
					</table>					
					<h4 class="text-right"><b>Total Pembayaran Rp. <span id="toata"></span></b></h4>
					
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
			sumval=sumval+parseInt(table.rows[i].cells[12].innerHTML);
		}
		$('#toata').html(numberWithCommas(sumval));
</script>
</html>