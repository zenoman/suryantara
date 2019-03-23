@extends('layout.masteradminnew')
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
@if(Session::get('level') == 'admin')
<script type="text/javascript">
    window.location.href = '{{url("/dashboard")}}';
</script>
@endif
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
										<i class="fa fa-users"></i>
									</div>
									<div class="caption">Pengeluaran Gaji Karyawan</div>
								</li>
							</ul>
						</div>
						<div>
							@if(Session::get('backup_step')==1)
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

							
							<a onclick="return confirm('Apakah data telah benar-benar terbackup ?')"href="{{url('/hapuspendapatan/'.$bulan.'/'.$tahun.'')}}" class="btn btn-danger btn-square-icon">
								<i class="fa fa-trash"></i>
								Hapus Data
							</a>
						</div>
						@elseif(Session::get('backup_step')==2)
						<header class="steps-numeric-title">Backup Pengeluaran Vendor</header>
						<div class="form-group">
							<a href="{{url('/exsportpengeluaran/'.$bulan.'/'.$tahun.'')}}" class="btn btn-success btn-square-icon">
								<i class="fa fa-file-excel-o"></i>
								Exsport Excel
							</a>
							<a id="pendapatan_cetak" href="{{url('/printpengeluaran/'.$bulan.'/'.$tahun.'')}}" target="_blank()" class="btn btn-info btn-square-icon">
								<i class="fa fa-print"></i>
								Cetak Data
							</a>

							
							<a onclick="return confirm('Apakah data telah benar-benar terbackup ?')"href="{{url('/hapuspengeluaran/'.$bulan.'/'.$tahun.'')}}" class="btn btn-danger btn-square-icon">
								<i class="fa fa-trash"></i>
								Hapus Data
							</a>
						</div>
						@elseif(Session::get('backup_step')==3)
						<header class="steps-numeric-title">Backup Pengeluaran Lainya</header>
						<div class="form-group">
							<a href="{{url('/exsportpengeluaranlain/'.$bulan.'/'.$tahun.'')}}" class="btn btn-success btn-square-icon">
								<i class="fa fa-file-excel-o"></i>
								Exsport Excel
							</a>
							<a href="{{url('/printpengeluaranlain/'.$bulan.'/'.$tahun.'')}}" target="_blank()" class="btn btn-info btn-square-icon">
								<i class="fa fa-print"></i>
								Cetak Data
							</a>

							
							<a onclick="return confirm('Apakah data telah benar-benar terbackup ?')"href="{{url('/hapuspengeluaranlain/'.$bulan.'/'.$tahun.'')}}" class="btn btn-danger btn-square-icon">
								<i class="fa fa-trash"></i>
								Hapus Data
							</a>
						</div>
						@elseif(Session::get('backup_step')==4)
						<header class="steps-numeric-title">Pengeluaran Gaji Karyawan</header>
						<div class="form-group">
							<a href="{{url('/exsporgajikaryawan/'.$bulan.'/'.$tahun.'')}}" class="btn btn-success btn-square-icon">
								<i class="fa fa-file-excel-o"></i>
								Exsport Excel
							</a>
							<a href="{{url('/printgajikaryawan/'.$bulan.'/'.$tahun.'')}}" target="_blank()" class="btn btn-info btn-square-icon">
								<i class="fa fa-print"></i>
								Cetak Data
							</a>
							<a onclick="return confirm('Apakah data telah benar-benar terbackup ?')"href="{{url('/hapusgajikaryawan/'.$bulan.'/'.$tahun.'')}}" class="btn btn-danger btn-square-icon">
								<i class="fa fa-trash"></i>
								Hapus Data
							</a>
						</div>
						@endif
						@if(Session::get('backup_step')==4)
						
						<a href="{{url('/selesai')}}" class="btn btn-rounded float-right">Selesai
							</a>
						@else
						<a href="{{url('/selanjutnya')}}" class="btn btn-rounded float-right">Selanjutnya →
							</a>
						@endif
						
					</section>
				</div>
			</div>
		</div>
	</div>
	
@endsection
@section('js')
	
@endsection
