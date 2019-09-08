<!DOCTYPE html>
<html>
<head>
	<title>Cetak {{$pil}} Akutansi Tanggal {{$tgl}} Sampai {{$tgl0}}</title>
	<link rel="stylesheet" href="{{asset('assets/css/lib/bootstrap/bootstrap.min.css')}}">	
</head>
<body>
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
						{{$pil}} Tanggal {{$tgl}} Sampai {{$tgl0}}
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
		    @if($kh=="sa")
				<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Pemegang</th>
							<th>Telp</th>
							<th>tgl</th>
							<th>Status</th>		
						</tr>
						</thead>
						<tbody>
						<?php $i = 1;?>
						<?php $j = 0;?>						
						@foreach($data as $row)
                            <?php $no = $i++;?>
                            <?php $n = $j++;?>
                        <tr>
							<td align="center">{{$no}}</td>
							<td align="center">{{$row->kode}}</td>
							<td align="center">{{$row->pemegang}}</td>
							<td align="center">{{$row->telp}}</td>							
							<td align="center">{{$row->tgl}}</td>
							<td align="center">
								@if ($row->status=="S")
									<p>Sampai</p>
								@else
									<p>Belum</p>
								@endif
							</td>							
                        </tr>
						@endforeach
						</tbody>										

					</table>
		    @elseif($kh=="pajak")					
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Bulan</th>
							<th>Tahun</th>
							<th>Keterangan</th>
							<th>Total</th>	
						</tr>
						</thead>
						<tbody>
						<?php $i = 1;?>
						<?php $j = 0;?>						
						@foreach($data as $row)
                            <?php $no = $i++;?>
                            <?php $n = $j++;?>
                        <tr>
							<td align="center">{{$no}}</td>
							<td align="center">{{$row->bulan}}</td>
							<td align="center">{{$row->tahun}}</td>
							<td align="center">{{$row->nama_pajak}}</td>							
							<td align="center">Rp. {{number_format($row->total)}}</td>
							<td align="center" class="tdtot">{{$row->total}}</td>					
                        </tr>
						@endforeach
						</tbody>										

					</table>
			@else
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>No Resi</th>
							<th>Admin</th>
							<th>Tujuan</th>
							<th>tgl</th>
							<th>Berat</th>							
							<th>Sub Total</th>
						</tr>
						</thead>
						<tbody>
						<?php $i = 1;?>
						<?php $j = 0;?>						
						@foreach($data as $row)
                            <?php $no = $i++;?>
                            <?php $n = $j++;?>
                        <tr>
							<td align="center">{{$no}}</td>
							<td align="center">{{$row->kode}}</td>
							<td align="center">{{$row->admin}}</td>
							<td align="center">{{$row->tujuan}}</td>							
							<td align="center">{{$row->tgl}}</td>
							<td align="center">{{$row->totalkg}}</td>
							<td align="center">Rp. {{number_format($row->totalcash)}}</td>
							<td align="center" class="tdtot">{{$row->totalcash}}</td>
                        </tr>
						@endforeach
						</tbody>										

				</table>
			@endif				
		<h4 class="pull-right"><b>Total Rp. <span id="toata"></span></b></h4>
					
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
        var pil= "{{$kh}}";
		for(var i=1;i<table.rows.length;i++){
			if(pil=="pajak"){
					sumval=sumval+parseInt(table.rows[i].cells[5].innerHTML);
				}else if(pil=="sa"){
					sumval=0;
				}
				else{
					sumval=sumval+parseInt(table.rows[i].cells[7].innerHTML);
				}
		}
		$('#toata').html(numberWithCommas(sumval));
</script>
</html>