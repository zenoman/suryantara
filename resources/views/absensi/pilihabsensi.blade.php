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
							<h2>Pilih Laporan Absnsi</h2>
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
										Absensi Harian
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#tabs-1-tab-2" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<!-- <span class="glyphicon glyphicon-import"></span> -->
										Absensi Bulanan
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div><!--.tabs-section-nav-->

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active show" id="tabs-1-tab-1">
												<br>

               <form action="{{url('tampilabsensiharian') }}" role="form" method="GET">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Tanggal</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<select class="select2" name="tanggal">
								@foreach($tgl as $row)
								<option value="{{$row->tanggal}}">
									{{$row->tanggal}}
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
								<input class="btn btn-primary" type="submit" name="submit" onclick="return confirm('Tampilkan Data Absensi Harian?')" value="Lanjut">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
							</small>
				</form>
					</div><!--.tab-pane-->

					<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-2">
						<br>
				<form action="{{url('/tampilabsensibulanan') }}" role="form" method="GET">
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Bulan</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<select class="select2" name="tanggal">
								@foreach($bln as $row)
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
	<script>
		$(function() {
			$("#example-basic ").steps({
				headerTag: "h3",
				bodyTag: "section",
				transitionEffect: "slideLeft",
				autoFocus: true
			});

			var form = $("#example-form");
			form.validate({
				rules: {
					agree: {
						required: true
					}
				},
				errorPlacement: function errorPlacement(error, element) { element.closest('.form-group').find('.form-control').after(error); },
				highlight: function(element) {
					$(element).closest('.form-group').addClass('has-error');
				},
				unhighlight: function(element) {
					$(element).closest('.form-group').removeClass('has-error');
				}
			});

			form.children("div").steps({
				headerTag: "h3",
				bodyTag: "section",
				transitionEffect: "slideLeft",
				onStepChanging: function (event, currentIndex, newIndex)
				{
					form.validate().settings.ignore = ":disabled,:hidden";
					return form.valid();
				},
				onFinishing: function (event, currentIndex)
				{
					form.validate().settings.ignore = ":disabled";
					return form.valid();
				},
				onFinished: function (event, currentIndex)
				{
					alert("Submitted!");
				}
			});

			$("#example-tabs").steps({
				headerTag: "h3",
				bodyTag: "section",
				transitionEffect: "slideLeft",
				enableFinishButton: false,
				enablePagination: false,
				enableAllSteps: true,
				titleTemplate: "#title#",
				cssClass: "tabcontrol"
			});

			$("#example-vertical").steps({
				headerTag: "h3",
				bodyTag: "section",
				transitionEffect: "slideLeft",
				stepsOrientation: "vertical"
			});
		});
	</script>
@endsection
