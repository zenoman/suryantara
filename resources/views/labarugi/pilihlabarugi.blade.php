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
							<h2>Laba Rugi</h2>
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
										Laba Rugi
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#tabs-1-tab-2" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										Labarugi Tahunan
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div><!--.tabs-section-nav-->

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active show" id="tabs-1-tab-1">
												<br>

               <form action="{{url('tampillabarugi') }}" role="form" method="GET">
					
					
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
								<option value="semua">Semua Kategori</option>
								@foreach($kate as $row)
								<option value="{{$row->kode}}">
									{{$row->nama}}
								</option>
								@endforeach
								@foreach($katers as $row)
								<option value="{{$row->kode}}">
									{{$row->nama}}
								</option>
								@endforeach
								@foreach($katesj as $row)
								<option value="{{$row->kode}}">
									{{$row->nama}}
								</option>
								@endforeach
								@foreach($katepj as $row)
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
								<input class="btn btn-primary" type="submit" name="submit" onclick="return confirm('Tampilkan Data Laba Rugi?')" value="Lanjut">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
							</small>
				</form>
					</div><!--.tab-pane-->
				<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-2">
						<br>
				<form action="{{url('tampillabarugithn') }}" role="form" method="GET">

					<input type="hidden" name="thn" value="tahun">

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Tahun</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<select class="select2" name="tahun">
									<option>Pilih</option>
								@foreach($thn as $row)
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
						{{csrf_field()}}
							<small class="text-muted text-right">
								
								<input class="btn btn-primary" type="submit" name="submit" onclick="return confirm('Tampilkan Laporan Laba rugi ?')" value="Lanjut">
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
