@extends('layout.masteradminnew')

@section('css')
	<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/select2.min.css')}}">
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
							<h2>Absensi Bulanan</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<a href="{{url('/pilihabsensiharian')}}" class="btn btn-primary">Absensi Harian</a>
				<a href="{{url('/pilihabsensibulanan')}}" class="btn btn-success">Absensi Bulanan</a>
				<p><br></p>
				<form action="{{url('/tampilabsensibulanan') }}" role="form" method="GET">
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Bulan</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<select class="select2" name="tanggal">
								@foreach($tgl as $row)
								<option value="{{$row->tahun.'-'.$row->bulan}}">
									{{$row->bulan.'-'.$row->tahun}}
								</option>
								@endforeach
							</select>
							</p>
							 @if($errors->has('tanggal'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('tanggal')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Jabatan</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<select class="select2" name="jabatan">
								<option value="semua">Semua</option>
								@foreach($absen as $vn)
								<option value="{{$vn->id_jabatan."-".$vn->jabatan}}">
									{{$vn->jabatan}}
								</option>
								@endforeach
							</select>
							</p>
							 
						</div>
					</div>
						{{csrf_field()}}
							<small class="text-muted text-right">
								
								<input class="btn btn-primary" type="submit" name="submit" onclick="return confirm('Tampilkan Tampil Data Absensi Bulanan ?')" value="Lanjut">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
							</small>
				</form>
			</div>
		</div>
	</div>

@endsection

@section('js')
	<script src="{{asset('assets/js/lib/select2/select2.full.min.js')}}"></script>
@endsection
