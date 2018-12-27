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
							<h2>Pilih Laporan Pengeluaran</h2>
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
				<form action="{{url('laporanpengeluaran') }}" role="form" method="POST">
					
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
						<label class="col-sm-2 form-control-label semibold">Vendor</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<select class="select2" name="vendor">
								<option value="semua">Semua</option>
								@foreach($vendor as $vn)
								<option value="{{$vn->tujuan}}">
									{{$vn->tujuan}}
								</option>
								@endforeach
							</select>
							</p>
							 
						</div>
					</div>
						{{csrf_field()}}
							<small class="text-muted">
								
								<input class="btn btn-primary" type="submit" name="submit" onclick="return confirm('Tampilkan Laporan Pemasukan ?')" value="Lanjut">
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
