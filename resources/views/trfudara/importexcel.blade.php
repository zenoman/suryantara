@extends('layout.masteradminnew')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/jquery-steps.min.css')}}">
@endsection

@section('content')
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Import excel</h2>
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
										<i class="font-icon font-icon-notebook-bird"></i>
										Penjelasan
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#tabs-1-tab-2" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-import"></span>
										Import Excel
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#tabs-1-tab-3" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-export"></span>
										Export Excel
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div><!--.tabs-section-nav-->

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active show" id="tabs-1-tab-1">
												<br>

                                               <li>Download file template excel di tab <b>import Excel.</b> Seperti gambar dibawah ini lalu klik tombol <b>Download Template Excel</b> & <b>Download Data Cabang</b>.</li><br>
                                               <img src="{{url('img/import_export/001.JPG')}}"  width="60%">
                                               <p>
                                               <li>
                                                   Buka file <b>"template tarif Udara.xlsx"</b> kemudian isi data seperti gambar dibawah perhatikan pada bagian <b>tarif_perkg, minimal_heavy, tarif_dokumen dan berat_minimal</b> hanyan diisi dengan angka saja. untuk <b>id_cabang</b> isi berdasarkan kode cabang yang berada di file data cabang.
                                               </li><br>
                                               <img src="{{url('img/import_export/udara.JPG')}}" width="70%">
                                               <p>
                                               <div class="alert alert-danger">
                                                <b>NB</b> : Pastikan Untuk <b>tidak</b> menggunakan kode tujuan yang sudah ada. Kode tujuan yang sama <b>Otomatis tidak tersimpan</b>.
                                               </div>
                                               <br>
                                               <li>Kemudian save <b>template tarif Udara.xlsx</b> dan upload di tab sebelah bagian <b>import Excel.</b> Seperti gambar dibawah ini, Lalu klik <b>upload file</b>.</li><br>
                                               <img src="{{url('img/import_export/001.JPG')}}"  width="60%"><br><br>
                                               <li>Untuk export tarif udara sangat sederhana.Lihat gambar dibawah ini.</li><br>
                                               <img src="{{url('img/import_export/004.JPG')}}"  width="60%">
                                               <br><p></p>
                                               <div class="alert alert-danger">
                                                <b>NB</b> : Untuk mengurangi kesalahan saat import excel, pastikan data di excel tidak lebih dari 40 baris. 
                                               </div>
                                               <br></br>
<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
					</div><!--.tab-pane-->
					<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-2">
						<div class="panel-body" align="center">
							<a href="{{url('exsportcabang')}}" class="btn btn-primary">Download Data Cabang</a>
                                            <a href="{{url('trfudara/download')}}" class="btn btn-info">Download Template Excel</a>
                        </div>
                        <hr>
<p></p>
                        <div class="panel panel-default" align="center">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                Upload File
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <form action="{{url('/trfudara/prosesimportexcel')}}" role="form" method="POST" enctype="multipart/form-data">
                                       <div class="form-group">
                                            <label>File excel</label>
                                            <input type="file"name="file" required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                              <p class="help-block">*File excel tidak boleh kosong</p>
                                        </div>
                                        {{csrf_field()}}
                                      <input class="btn btn-primary" type="submit" name="submit" value="simpan">
                                        
                                        
                                    </form> 
                                        </div>
                                    </div>
                                </div>
<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
                                    </div><!--.tab-pane-->
                    <div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-3">
						<div class="panel-body" align="center">
                                    <a href="{{url('trfudara/exporttrfudara')}}" class="btn btn-primary">Export Tarif Udara</a>
                        </div>
                        <hr>
<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
                                    </div><!--.tab-pane-->
				</div><!--.tab-content-->
			</section><!--.tabs-section-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->
@endsection

@section('js')
<script src="{{asset('assets/js/lib/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/js/lib/jquery-steps/jquery.steps.min.js')}}"></script>
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