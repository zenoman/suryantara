@extends('layout.masteradminnew')


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
							<th>Omset Awal</th>
							<th>Pemasukan</th>
							<th>Pengeluaran</th>
							<th>Pengeluaran Gaji karyawan</th>
							<th>Pengeluaran lainya</th>
							<th>Pajak</th>
							<th>Saldo</th>
						</tr>
						</thead>
						<tfoot>
						<tr> 
							<th>No</th>
							<th>Bulan</th>
							<th>Omset Awal</th>
							<th>Pemasukan</th>
							<th>Pengeluaran</th>
							<th>Pengeluaran Gaji karyawan</th>
							<th>Pengeluaran lainya</th>
							<th>Pajak</th>
							<th>Saldo</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->bulan}}-{{$row->tahun}}</td>
                            <td>{{"Rp ".number_format($row->omset_awal,0,',','.')}}</td>
                            <td>{{"Rp ".number_format($row->pemasukan,0,',','.')}}</td>
                            <td>{{"Rp ".number_format($row->pengeluaran,0,',','.')}}</td>
                            <td>{{"Rp ".number_format($row->gaji_karyawan,0,',','.')}}</td>
                            <td>{{"Rp ".number_format($row->pengeluaran_lainya,0,',','.')}}</td>
							<td>{{"Rp ".number_format($row->pajak,0,',','.')}}</td>
							<td>{{"Rp ".number_format($row->laba,0,',','.')}}</td>
                        </tr>
						@endforeach
						</tbody>
					</table>
					<br>
					<div class="text-right">
<a href="{{url('/omset/export')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan Omset</a>
							&nbsp;&nbsp;
								<a href="{{url('/printomset')}}" target="_blank()" class="btn btn-primary">
								<i class="fa fa-print"></i>
								Cetak Data
							</a>	
							&nbsp;&nbsp;
							<button type="button" onclick="window.history.go(-1);" class="btn btn-danger">
								Kembali
							</button>
					</div>
				</div>
			</section>
		</div>
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
