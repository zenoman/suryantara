@extends('layout.masteradminnew')

@section('header')
@foreach($webinfo as $row)
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
							<h2>Lacak Resi</h2>
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
				<form method="get" action="{{url('resipengiriman/lacakresi')}}">
					
					<div class="form-group row">
						<label class="col-sm-3 form-control-label semibold">
						</label>
						<div class="col-sm-6 text-center">
							<h2>Masukan Nomor Resi</h2>
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-search"></span>
								</div>
								<input type="text" class="form-control" name="resi" required>
							</div>
								{{csrf_field()}}
								<br>
								<input class="btn btn-primary btn-lg" type="submit" name="submit" value="Cari">

								<a onclick="window.history.go(-1);" class="btn btn-danger btn-lg">Kembali</a>
						</div>
						<label class="col-sm-3 form-control-label semibold">
						</label>
					</div>
				</form>
			</div>
		</div>
	</div>

        @endsection

