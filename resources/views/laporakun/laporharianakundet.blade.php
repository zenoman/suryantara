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
							<h2>Laporan @foreach($nama as $row){{$row->nama}}@endforeach tgl {{$tgl}} Sampai {{$tgl0}}</h2>
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
							<th>Admin</th>
							<th>Kategori</th>
							<th>tgl</th>
							<th>jumlah</th>
						</tr>
						</thead>
						<tbody>
						<?php $i = 1;?>
						<?php $j = 0;?>
						@if($kat == 233)
						@foreach($data as $row)
                            <?php $no = $i++;?>
                            <?php $n = $j++;?>
						{{-- @foreach($totsurat[$n] as $ros) --}}
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->admin}}</td>
                            <td>{{$row->nama}}</td>
                            <td>{{$row->tgl}}</td>
							<td>{{"Rp ".number_format($ros->totalnya,0,',','.')}}</td>
							<td class="tdtot">{{$row->total_biaya}}</td>
                        </tr>
						{{-- @endforeach --}}
						@endforeach
<!-- ===================================================== -->

						@elseif($kat == 211)
								@foreach($data as $row)
		                            <?php $no = $i++;?>
		                            <?php $n = $j++;?>
								{{-- @foreach($totpajak[$n] as $ros) --}}
		                        <tr>
		                            <td>{{$no}}</td>
		                            <td>{{$row->admin}}</td>
		                            <td>{{$row->nama}}</td>
		                            <td>{{$row->bulan}}-{{$row->tahun}}</td>
									<td>{{"Rp ".number_format($ros->totalnya,0,',','.')}}</td>
		                        </tr>
								{{-- @endforeach --}}
								@endforeach
<!-- ===================================================== -->

						@elseif($kat == 122)
								@foreach($data as $row)
		                            <?php $no = $i++;?>
		                            <?php $n = $j++;?>
								{{-- @foreach($totresi[$n] as $ros) --}}
		                        <tr>
		                            <td>{{$no}}</td>
		                            <td>{{$row->admin}}</td>
		                            <td>{{$row->nama}}</td>
		                            <td>{{$row->tgl_lunas}}</td>
									<td>{{"Rp ".number_format($ros->totalnya,0,',','.')}}</td>
		                        </tr>
								{{-- @endforeach --}}
								@endforeach
<!-- ===================================================== -->

						@else
						@foreach($data as $row)
                            <?php $no = $i++;?>
                            <?php $n = $j++;?>
                            {{-- @foreach($tot[$n] as $ros) --}
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->admin}}</td>
                            <td>{{$row->nama}}</td>
                            <td>{{$row->tgl}}</td>
							<td>{{"Rp ".number_format($ros->totalnya,0,',','.')}}</td>
                        </tr>
						{{-- @endforeach --}
						@endforeach

						@endif
						</tbody>
						<tfoot>
						<tr> 
							<th>No</th>
							<th>Admin</th>
							<th>Kategori</th>
							<th>tgl</th>
							<th>jumlah</th>
						</tr>
						</tfoot>
						
					</table>
					{{ $data->links() }}
				</div>
			</section>

						@if($kat == 233)
			@foreach($totsuratthn as $ttl)
			<section class="card">
				<div class="card-block">
					<h2>Total <b>{{"Rp ".number_format($ttl->totalnya,0,',','.')}}</b></h2>
					<div class="pull-right">
					<!-- <a href="{{url('/export_laporakun/'.$kate.'/'.$tgl.'/'.$tgl0.'')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan</a> -->
					<a href="{{url('/printlapoakundet/'.$kat.'/'.$tgl.'/'.$tgl0.'')}}" target="_blank()" class="btn btn-primary">
					<i class="fa fa-print"></i>Cetak Data</a>
							&nbsp;&nbsp;
							<button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right">
								Kembali
							</button>
						
							
					</div>
				</div>
			</section>
			@endforeach
						@elseif($kat == 122)
			@foreach($totresithn as $ttl)
			<section class="card">
				<div class="card-block">
					<h2>Total <b>{{"Rp ".number_format($ttl->totalnya,0,',','.')}}</b></h2>
					<div class="pull-right">
					<!-- <a href="{{url('/export_laporakun/'.$kate.'/'.$tgl.'/'.$tgl0.'')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan</a> -->
					<a href="{{url('/printlapoakundet/'.$kat.'/'.$tgl.'/'.$tgl0.'')}}" target="_blank()" class="btn btn-primary">
					<i class="fa fa-print"></i>Cetak Data</a>
							&nbsp;&nbsp;
							<button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right">
								Kembali
							</button>
						
							
					</div>
				</div>
			</section>
			@endforeach
						@elseif($kat == 211)
			@foreach($totpajakthn as $ttl)
			<section class="card">
				<div class="card-block">
					<h2>Total <b>{{"Rp ".number_format($ttl->totalnya,0,',','.')}}</b></h2>
					<div class="pull-right">
					<!-- <a href="{{url('/export_laporakun/'.$kate.'/'.$tgl.'/'.$tgl0.'')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan</a> -->
					<a href="{{url('/printlapoakundet/'.$kat.'/'.$tgl.'/'.$tgl0.'')}}" target="_blank()" class="btn btn-primary">
					<i class="fa fa-print"></i>Cetak Data</a>
							&nbsp;&nbsp;
							<button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right">
								Kembali
							</button>
						
							
					</div>
				</div>
			</section>
			@endforeach
						@else
			@foreach($tose as $ttl)
			<section class="card">
				<div class="card-block">
					<h2>Total <b>{{"Rp ".number_format($ttl->totalnya,0,',','.')}}</b></h2>
					<div class="pull-right">
					<!-- <a href="{{url('/export_laporakun/'.$kate.'/'.$tgl.'/'.$tgl0.'')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Laporan</a> -->
					<a href="{{url('/printlapoakundet/'.$kat.'/'.$tgl.'/'.$tgl0.'')}}" target="_blank()" class="btn btn-primary">
					<i class="fa fa-print"></i>Cetak Data</a>
							&nbsp;&nbsp;
							<button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right">
								Kembali
							</button>
						
							
					</div>
				</div>
			</section>
			@endforeach
						@endif


			
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
		$('document').ready(function(){
			$('.tdtot').hide();
		});
		// Call Sum
		function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}

		var table=document.getElementById('example'),sumval=0;
		for(var i=1;i<table.rows.length;i++){
			// sumval=sumval+parseInt(table.rows[i].cells[5].innerHTML);
			sumval=sumval+parseInt(table.rows[i].cells[6].innerHTML);
		}
		document.getElementById('toata').innerHTML=numberWithCommas(sumval);
		
	</script>
	@endsection