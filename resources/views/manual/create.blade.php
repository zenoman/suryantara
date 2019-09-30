@extends('layout.masteradminnew')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/select2.min.css')}}">
@endsection
@section('content')
<div class="page-content">
		<div class="container-fluid">
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Input Manual</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<form action="{{ url('Manual') }}" role="form" method="POST">
					<label class="form-label" for="exampleInputDisabled">Pemegang</label>
					<select class="select2" name="pemegang">
						@foreach($karyawan as $kar)
						<option value="{{$kar->id}}">
							{{$kar->nama}}
						</option>
						@endforeach
					</select>
					<br><hr>
					<label class="form-label" for="exampleInputDisabled">No Resi</label>
					<select class="form-control" name="resinya[]" multiple>
						@foreach($resinnya as $resi)
						<option value="{{$resi->id}}-{{$resi->no_resi}}">
							{{$resi->no_resi}}
						</option>
						@endforeach
					</select>
					{{csrf_field()}}
							<small class="text-muted text-right">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
							</small>
				</form>
			</div>
			</div>
			</div>
        @endsection
		@section('js')
		<script src="{{asset('assets/js/lib/select2/select2.full.min.js')}}"></script>
		<script src="{{asset('assets/class.php')}}"></script>
	@endsection