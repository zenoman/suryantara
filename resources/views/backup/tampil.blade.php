@extends('layout.masteradmin')
@section('css')
<link rel="stylesheet" href="{{asset('assets/css/separate/elements/steps.min.css')}}">
@endsection

@section('header')
	@foreach($title as $row)
		<title>{{$row->namaweb}}</title>
		<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
	@endforeach
@endsection

@section('content')
<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Backup Data Bulan {{$bulan}} Tahun {{$tahun}}</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="row">
				
				<div class="col-xl-12">
					<section class="box-typical steps-icon-block">
						<div class="steps-icon-progress">
							<ul>

								<li class="active">
									<div class="icon">
										<i class="fa fa-arrow-down"></i>
									</div>
									<div class="caption">Pendapatan</div>
								</li>
								@if(Session::get('backup_step')>1)
								<li class="active">
								@else
								<li>
								@endif
									<div class="icon">
										<i class="fa fa-arrow-up"></i>
									</div>
									<div class="caption">Pengeluaran Vendor</div>
								</li>
								@if(Session::get('backup_step')>2)
								<li class="active">
								@else
								<li>
								@endif 
									<div class="icon">
										<i class="fa fa-arrow-up"></i>
									</div>
									<div class="caption">Pengeluaran Lainya</div>
								</li>
								@if(Session::get('backup_step')>3)
								<li class="active">
								@else
								<li>
								@endif
									<div class="icon">
										<i class="fa fa-bar-chart"></i>
									</div>
									<div class="caption">Omset</div>
								</li>
							</ul>
						</div>
						<div>
							<header class="steps-numeric-title">Backup Pendapatan</header>
						<div class="form-group">
							<a href="{{url('/exsportpendapatan/'.$bulan.'/'.$tahun.'')}}" class="btn btn-success btn-square-icon">
								<i class="fa fa-file-excel-o"></i>
								Exsport Excel
							</a>
							<a id="pendapatan_cetak" href="{{url('/printpendapatan/'.$bulan.'/'.$tahun.'')}}" target="_blank()" class="btn btn-info btn-square-icon">
								<i class="fa fa-print"></i>
								Cetak Data
							</a>
							@if(Session::get('backup_status')=='n')
							<a onclick="alert('Backup Data Terlebih Dahulu !')" class="btn btn-danger btn-square-icon">
								<i class="fa fa-trash"></i>
								Hapus Data
							</a>
							@else
							<a href="{{url('/printpendapatan/'.$bulan.'/'.$tahun.'')}}" class="btn btn-danger btn-square-icon">
								<i class="fa fa-trash"></i>
								Hapus Data
							</a>
							@endif
						</div>
						
						<!-- <button type="button" class="btn btn-rounded btn-grey float-left">← Back</button> -->
						<button type="button" class="btn btn-rounded float-right">Selanjutnya →</button>
						</div>
						
					</section>
				</div>
			</div>
		</div>
	</div>
	
@endsection
@section('js')

@endsection
