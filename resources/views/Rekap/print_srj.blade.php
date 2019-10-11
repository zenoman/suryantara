<!DOCTYPE html>
<html>
<head>
	<title>Cetak Surat Jalan {{$kate}} Tanggal {{$bul1}} Sampai {{$bul2}}</title>
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
					    Rekap Surat Jalan {{$kate}} Tanggal {{$bul1}} Sampai {{$bul2}}
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
                            <th>Tanggal</th>
                            <th>Admin</th>
                            <th>Vendor</th>
                            <th>Tujuan</th>
                            <th>Biaya</th>
						</tr>
						</thead>						
						<tbody>
                            <?php $nomer = 1;?>
                            @foreach($data as $row)
                            <tr>
                                <td>{{$nomer++}}</td>
                                <td>{{$row->kode}}</td>                                
                                <td>{{$row->tgl}}</td>    
                                <td>{{$row->admin}}</td>                           
                                <td>
                                    {{$row->tujuan}}
                                </td>
                                <td>{{$row->alamat_tujuan}}</td>
                                <td>Rp. {{number_format($row->biaya)}}</td>
                            </tr>
						@endforeach	
						<tr>
                            <td colspan="6" align="right"><b>Total</b></td>
                            <td ><b>Rp. {{number_format($total->tbiaya)}}</b></td>
                        </tr>				
						</tbody>
					</table>					
					
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
</script>
</html>