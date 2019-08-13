@extends('layout.masteradminnew')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/jquery-steps.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/select2.min.css')}}">
@endsection

@section('content')
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Pilih Laporan</h2>
							<!-- <div class="subtitle">Welcome to Ultimate Dashboard</div> -->
						</div>
					</div>
				</div>
			</header>

			<section class="tabs-section">
				<div class="tabs-section-nav tabs-section-nav-icons">
					<div class="tbl">
						<ul class="nav" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" href="#tabs-1-tab-1" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<!-- <i class="font-icon font-icon-notebook-bird"></i> -->
										Laporan Harian
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div><!--.tabs-section-nav-->

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active show" id="tabs-1-tab-1">
												<br>

               <form action="{{url('tampillaporanakundet') }}" role="form" method="GET">
					
					
					<div class="form-group row">
						<label class="col-sm-1 form-control-label semibold">Dari Tanggal
						</label>
						<div class="col-sm-5">
							<div class="input-group">
								<input
								type="date"
								class="form-control"
								value="{{date('Y-m-d')}}"
								name="tgl"
								required
								>
							</div>
						</div>
						<label class="col-sm-1 form-control-label semibold">Sampai Tanggal
						</label>
						<div class="col-sm-5">
							<div class="input-group">
								<input
								type="date"
								class="form-control"
								value="{{date('Y-m-d')}}"
								name="tgl0"
								required
								>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-1 form-control-label semibold">Kategori</label>
						<div class="col-sm-11">
							<p class="form-control-static">
								<select class="select2" name="kategori">
							<option selected disabled hidden>Pilih Kategori</option>
								@foreach($katers as $ro)
								<option value="{{$ro->kode}}">
									{{$ro->nama}}hay
								</option>
								@endforeach
								@foreach($katesj as $r)
								<option value="{{$r->kode}}">
									{{$r->nama}}hay
								</option>
								@endforeach
								@foreach($katepj as $rowa)
								<option value="{{$rowa->kode}}">
									{{$rowa->nama}}hay
								</option>
								@endforeach
								@foreach($kate as $row)
								<option value="{{$row->kode}}">
									{{$row->nama}}
								</option>
								@endforeach
							</select>
							</p>
							 @if($errors->has('kategori'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('kategori')}}
                                         </div>
                                       @endif
						</div>
					</div>
						{{csrf_field()}}
							<small class="text-muted text-right">
								<input class="btn btn-primary" type="submit" name="submit" onclick="return confirm('Tampilkan Laporan Detail Akutansi?')" value="Lanjut">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
							</small>
				</form>
					</div><!--.tab-pane-->

				</div><!--.tab-content-->
			</section><!--.tabs-section-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->
@endsection

@section('js')
<script src="{{asset('assets/js/lib/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/js/lib/jquery-steps/jquery.steps.min.js')}}"></script>
<script src="{{asset('assets/js/lib/select2/select2.full.min.js')}}"></script>

@endsection
