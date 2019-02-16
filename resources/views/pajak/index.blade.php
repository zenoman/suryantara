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
							<h2>Pilih Pajak</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<form action="{{url('/tampilpajak') }}" role="form" method="GET">
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">tahun</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<select class="select2" name="tahun">
								<option value="semua">tampilkan semua</option>
								@foreach($data as $row)
								<option value="{{$row->tahun}}">
									{{$row->tahun}}
								</option>
								@endforeach
							</select>
							</p>
							 @if($errors->has('tahun'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('tahun')}}
                                         </div>
                                       @endif
						</div>
					</div>
							<small class="text-muted text-right">
								
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
