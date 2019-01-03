@extends('layout.masteradmin')


@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection


@section('css')
<link rel="stylesheet" href="{{asset('assets/css/lib/datatables-net/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/datatables-net.min.css')}}">
@endsection


@section('content')
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Omset Bulanan</h2>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Bulan</th>
							<th>pemasukan</th>
							<th>pengeluaran</th>
							<th>pengeluaran lainya</th>
							<th>Laba</th>
						</tr>
						</thead>
						<tfoot>
						<tr> 
							<th>No</th>
							<th>Bulan</th>
							<th>pemasukan</th>
							<th>pengeluaran</th>
							<th>pengeluaran lainya</th>
							<th>Laba</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->bulan}}-{{$row->tahun}}</td>
                            <td>{{"Rp ".number_format($row->pemasukan,0,',','.')}}</td>
                            <td>{{"Rp ".number_format($row->pengeluaran,0,',','.')}}</td>
                            <td>{{"Rp ".number_format($row->pengeluaran_lainya,0,',','.')}}</td>

							<td>{{"Rp ".number_format($row->laba,0,',','.')}}</td>
                        </tr>
						@endforeach
						</tbody>
					</table>
					<br>
					<div class="text-right">
						
							<button type="button" class="btn btn-primary" onclick="cetak()">
								cetak
							</button>	
							&nbsp;&nbsp;
							<button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right">
								Kembali
							</button>
						
							
					</div>
				</div>
			</section>

	
			
			
		</div>
	</div>
	

		<div id="hidden_div" style="display: none;">
		<table style="width: 100%">
			<tr>
				<td colspan="2" align="center">
					<b>
						Omset Bulanan
						
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
							<th>Bulan</th>
							<th>pemasukan</th>
							<th>pengeluaran</th>
							<th>pengeluaran lainya</th>
							<th>Laba</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->bulan}}-{{$row->tahun}}</td>
                            <td>{{"Rp ".number_format($row->pemasukan,0,',','.')}}</td>
                            <td>{{"Rp ".number_format($row->pengeluaran,0,',','.')}}</td>
                            <td>{{"Rp ".number_format($row->pengeluaran_lainya,0,',','.')}}</td>

							<td>{{"Rp ".number_format($row->laba,0,',','.')}}</td>
                        </tr>
						@endforeach
						</tbody>
					</table>
			</div>
	@endsection
		@section('js')
	<script src="{{asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>
	<script>
		$(function() {
			$('#example').DataTable({
            responsive: true
        });
		});

		
	</script>
	@endsection
	@section('otherjs')
	<script>
		function cetak(){
		var divToPrint=document.getElementById('hidden_div');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print();window.close()">'+divToPrint.innerHTML+'</body></html>');
		newWin.document.close();
		}
	</script>
	@endsection