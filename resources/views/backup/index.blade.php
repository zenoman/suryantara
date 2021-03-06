
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
							<h2>Pilih Bulan</h2>
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
				<form action="{{url('tampilbackup') }}" role="form" method="GET">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Bulan</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<select class="form-control" name="bulan">
									@php
									for($i=1;$i<=12;$i++){
									echo "<option value='".$i."'>".$i."</option>";
									}
									@endphp
								
							</select>
							</p>
							 
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Tahun</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<select name="tahun" class="form-control">
								@php
									for($ii=2019;$ii<(int)date('Y')+3;$ii++){
										echo"<option value='".$ii."'>".$ii."</option>";
									}
								@endphp
								
								</select>
							</p>
							 
						</div>
					</div>
						{{csrf_field()}}
							<small class="text-muted text-right">
								
								<input class="btn btn-primary" type="submit" name="submit" onclick="return confirm('Bulan / Tahun Benar ?')" value="Lanjut">
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
