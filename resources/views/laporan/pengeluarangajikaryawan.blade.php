@extends('layout.masteradmin')


@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection


@section('css')
<link rel="stylesheet" href="{{asset('assets/css/lib/datatables-net/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/jabatan/datatables-net.min.css')}}">
@endsection


@section('content')
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							
							<h2>Laporan Pengeluaran {{$bulanya}}</h2>
							
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					@if($jabatan!='semua')
							@foreach($jabatan as $rw)
						<h4>jabatan : {{$rw->jabatan}}</h4>
							@endforeach
					@endif
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode Karyawan</th>
							<th>Nama Karyawan</th>
							@if($jabatan!='semua')
							<th>Jabatan</th>
							@endif
							<th>Tanggal</th>
							<th>Gaji Pokok</th>
							<th>Uang Makan</th>
						</tr>
						</thead>
						<tfoot>
						<tr> 
							<th>No</th>
							<th>Kode Karyawan</th>
							<th>Nama Karyawan</th>
							@if($jabatan!='semua')
							<th>Jabatan</th>
							@endif
							<th>Tanggal</th>
							<th>Gaji Pokok</th>
							<th>Uang Makan</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->kode_karyawan}}</td>
                            <td>{{$row->nama_karyawan}}</td>
                            @if($jabatan=='semua')

                            @else
                            @foreach($jabatan as $rw)
                            <td>{{$rw->jabatan}}</td>
							@endforeach
							@endif
                            <td>{{$row->tgl}}</td>
							<td>{{"Rp ".number_format($row->gaji_pokok,0,',','.')}}</td>
							<td>{{"Rp ".number_format($row->uang_makan,0,',','.')}}</td>
                        </tr>
						@endforeach
						</tbody>
					</table>
					{{ $data->links() }}
				</div>
			</section>

	
			@foreach($total as $ttl)
			<section class="card">
				<div class="card-block">
					<h2>Total <b>{{"Rp ".number_format($ttl->total,0,',','.')}}</b></h2>
					<div class="pull-right">
						@if($jabatan=='semua')
                            
<a href="{{url('/export_laporan_pengeluaran_gaji_karyawan/'.$bulanya.'/'.$jabatan.'')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan</a>
                        @else
                        @foreach($jabatan as $row)
<a href="{{url('/export_laporan_pengeluaran_gaji_karyawan/'.$bulanya.'/'.$row->jabatan.'')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan</a>
						@endforeach
						@endif
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
	
			@endforeach
			
		</div>
	</div>
	

		<div id="hidden_div" style="display: none;">
		<table style="width: 100%">
			<tr>
				<td colspan="2" align="center">
					<b>
						@if($jabatan == 'semua')
						Laporan Pengeluaran Bulan {{$bulanya}} Semua Jabatan
						@else

							@foreach($jabatan as $roo)
						Laporan Pengeluaran di jabatan {{$roo->jabatan}} Bulan {{$bulanya}}
							@endforeach
						@endif
						
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
							<th>Kode Karyawan</th>
							<th>Nama Karyawan</th>
							@if($jabatan=='semua')
							<th>Jabatan</th>
							@endif
							<th>Tanggal</th>
							<th>Gaji Pokok</th>
							<th>Uang Makan</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $i = 1;?>
                            @foreach($data2 as $row)
                            <?php $no = $i++;?>
                        <tr>
                        	<td  align="center">{{$no}}</td>
                            <td  align="center">{{$row->kode_karyawan}}</td>
                            <td>{{$row->nama_karyawan}}</td>
                            @if($jabatan=='semua')
                            @else
                            @foreach($jabatan as $rw)
                            <td align="center">{{$rw->jabatan}}</td>
							@endforeach
							@endif
                            <td  align="center">{{$row->tgl}}</td>
							<td  align="center">{{"Rp ".number_format($row->gaji_pokok,0,',','.')}}</td>
							<td  align="center">{{"Rp ".number_format($row->uang_makan,0,',','.')}}</td>
                          
						</tr>
						@endforeach
						
						</tbody>
					</table>
					<p>Total : <b>{{"Rp. ".number_format($ttl->total,0,',','.')}}</b></p>
			</div>
	@endsection
		@section('js')
	<script src="{{asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>
	<script>
		$(function() {
			$('#example').DataTable({
            responsive: true,
            "paging":false
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