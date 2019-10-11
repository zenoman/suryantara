<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laba Rugi Bulan {{$bul1}} Sampai {{$bul2}} Tahun {{$th}}</title>
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
                        Laporan Laba Rugi Pusat Bulan {{$bul1}} Sampai {{$bul2}} Tahun {{$th}}
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
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Keterangan</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>Admin</th>
                            <th>Cabang</th>
						</tr>
						</thead>						
						<tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->bulan}}</td>
                                    <td>{{$item->tahun}}</td>
                                    <td>{{$item->keterangan}}</td>
                                    <td>Rp.{{number_format($item->debit,0,',','.')}}</td>
                                    <td>Rp.{{number_format($item->kredit,0,',','.')}}</td>
                                    <td>{{$item->admin}}</td>
                                    <td>{{$item->nama}}</td>
                                </tr>                                       
                            @endforeach
                            <tr>
                                <td colspan="4" align="right"> Total</td>
                                <td>Rp.{{number_format($tot->tdebit)}}</td>
                                <td>Rp.{{number_format($tot->tkredit)}}</td>
                                <td align="center"><b>Bersih</b></td>
                                <td align="center">Rp.<b>{{number_format($tot->tdebit-$tot->tkredit,0,',','.')}}</b></td>
                            </tr>				
						</tbody>
					</table>
</body>

<script src="{{asset('assets/js/lib/jquery/jquery-3.2.1.min.js')}}"></script>
<script>	
$(document).ready(function(){	
        window.print();
        });
        window.onafterprint = function() {
            history.go(-1);
        };
</script>
</html>