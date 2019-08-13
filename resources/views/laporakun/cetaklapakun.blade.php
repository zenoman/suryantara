<!DOCTYPE html>
<html>
<head>
	<title>Cetak {{$kat}} Akutansi Tanggal {{$tgl}} Sampai {{$tgl0}}</title>
	<link rel="stylesheet" href="{{asset('assets/css/lib/bootstrap/bootstrap.min.css')}}">	
</head>
<body>
		<table style="width: 100%" border="0">
			<tr>
				<td colspan="2" align="center">
					<b>
						{{$kat}} Tanggal {{$tgl}} Sampai {{$tgl0}}
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
								<th>Kategori</th>
								<th>tgl</th>
								<th>Sub Total</th>
						</tr>
						</thead>						
						<tbody>
						<?php $i = 1; $j = 0;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                            <?php $n = $j++;?>
                        <tr>
								<td align="center">{{$no}}</td>
								<td align="center">{{$row->no_resi}}</td>
								<td align="center">{{$row->admin}}</td>
								<td align="center">{{$row->nama}}</td>
								<td align="center">{{$row->tgl}}</td>
								<td align="center">{{number_format($row->total_biaya)}}</td>
								<td align="center" class="tdtot">{{$row->total_biaya}}</td>
						</tr>
						@endforeach						
						</tbody>
					</table>
					
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
		for(var i=1;i<table.rows.length;i++){
			// sumval=sumval+parseInt(table.rows[i].cells[5].innerHTML);
			sumval=sumval+parseInt(table.rows[i].cells[6].innerHTML);
		}
		$('#toata').html(numberWithCommas(sumval));
</script>
</html>