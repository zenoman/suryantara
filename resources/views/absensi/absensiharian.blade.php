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
							<h2>Data Absensi Tgl {{$tanggal}}</h2>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					@if($jabatan!='semua')
						<h4>Jabatan : {{$jabatan}}</h4>
					@endif
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode Karyawan</th>
							<th>Nama Karyawan</th>
							<th>Jabatan</th>
							<th>Masuk</th>
							<th>Izin</th>
							<th>Tidak Masuk</th>
						</tr>
						</thead>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->kode}}</td>
                            <td>{{$row->nama}}</td>
                            <td>{{$row->jabatan}}</td>
							<td>{{$row->masuk}}</td>
							<td>{{$row->izin}}</td>
							<td>{{$row->tidak_masuk}}</td>
                        </tr>
						@endforeach
						</tbody>
						<tfoot>
						<tr> 
							<th>No</th>
							<th>Kode Karyawan</th>
							<th>Nama Karyawan</th>
							<th>Jabatan</th>
							<th>Masuk</th>
							<th>Izin</th>
							<th>Tidak Masuk</th>
						</tr>
						</tfoot>
						
					</table>
					{{ $data->links() }}
				</div>
			</section>

			<section class="card">
				<div class="card-block">
					
					<div class="pull-right">
						@if($kodejabatan == 'semua')
                            
<a href="{{url('/export_absensi_harian/'.$tanggal.'/'.$jabatan)}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan</a>
                        @else
                        
<a href="{{url('/export_absensi_harian/'.$tanggal.'/'.$jabatan)}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan</a>
						
						@endif
							&nbsp;&nbsp;
								<a href="{{url('/printabsensiharian/'.$tanggal.'/'.$kodejabatan.'')}}" target="_blank()" class="btn btn-primary">
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