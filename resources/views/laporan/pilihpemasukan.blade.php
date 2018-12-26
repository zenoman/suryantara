@extends('layout.masteradmin')

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
							<h2>Pilih Laporan Pemasukan</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				@if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                    @endif
				<form action="{{url('laporanpemasukan') }}" role="form" method="POST">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Bulan</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<select class="select2" name="bulan">
								@foreach($bulan as $row)
								<option value="{{$row->bulan."-".$row->tahun}}">
									{{$row->bulan."-".$row->tahun}}
								</option>
								@endforeach
							</select>
							</p>
							 
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Jalur</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<div class="radio">
								<input type="jalur" id="radio-1" value="darat">
								<label for="radio-1">Jalur Darat </label>
								&nbsp;&nbsp;
								<input type="radio" name="jalur" id="radio-2" value="udara">
								<label for="radio-2">Jalur Udara </label>
								&nbsp;&nbsp;
								<input type="radio" name="jalur" id="radio-3" value="laut">
								<label for="radio-3">Jalur Laut </label>
								&nbsp;&nbsp;
								<input type="radio" name="jalur" id="radio-4" value="semua" checked="">
								<label for="radio-4">Semua Jalur </label>
							</div>
							</p>
						</div>
					</div>
					
						{{csrf_field()}}
							<small class="text-muted">
								
								<input class="btn btn-primary" type="submit" name="submit" onclick="return confirm('Tampilkan Laporan Pemasukan ?')" value="simpan">
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
