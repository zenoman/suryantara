@extends('layout.masteradmin')
@section('css')
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/select2.min.css')}}">
@endsection
@section('header')
@foreach($webinfo as $info)
<title>{{$info->namaweb}}</title>
<link href="{{asset('img/setting/'.$info->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('content')
<div class="page-content" id="printdiv">
		<div class="container-fluid">
		
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Buat Surat Jalan</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
					<p>No. Surat : <span id="noresi"></span></p>
				<form action="#" role="form" method="POST">
					<div class="form-group row">
						<input type="hidden" value="{{Session::get('id')}}" id="iduser">
						<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Tujuan</label>
							<div class="input-group">
								<input type="text" class="form-control" id="nama_barang" autofocus>
							</div>
						</div>
					</div>
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
					

>>>>>>> parent of fe21324... surat jalan part 1
					</div>
					<hr>
					<div class="form-group row">
					<div class="col-md-4 col-sm-6">
						<label class="form-label" for="exampleInputDisabled">No.Resi</label>
<<<<<<< HEAD
						<select class="select2" id="carinoresi"></select>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Penerima</label>
							<div class="input-group">
								<input type="text" class="form-control" id="penerima">
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-4">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Jumlah</label>
							<div class="input-group">
								<input type="text" class="form-control" id="jumlah" onkeypress="return isNumberKey(event)">
							<div class="input-group-addon"></div>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-4">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Berat</label>
							<div class="input-group">
								<input type="text" class="form-control" id="berat" onkeypress="return isNumberKey(event)">
							<div class="input-group-addon">Kg</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">tujuan</label>
							<div class="input-group">
								<input type="text" class="form-control" id="berat">
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
=======
					
					</div>
					<div class="row">
					<div class="col-md-12 col-sm-12">
>>>>>>> parent of 591ea06... Merge remote-tracking branch 'origin/master'
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Keterangan</label>
							<div class="input-group">
<<<<<<< HEAD
								<input type="text" class="form-control" id="isipaket">
<<<<<<< HEAD
								<span class="input-group-btn"><button class="btn btn-info bootstrap-touchspin-up" type="button" id="btntambah">tambah</button></span>
=======
					
					</div>
					<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Keterangan</label>
							<div class="input-group">
								<textarea rows="4" class="form-control" id="keterangan"></textarea>
>>>>>>> parent of 3f9982c... nyicil surat jalan
=======
>>>>>>> parent of a226352... surat jalan part 2 + db baru
=======
								<textarea rows="4" class="form-control" id="keterangan"></textarea>
>>>>>>> parent of 591ea06... Merge remote-tracking branch 'origin/master'
							</div>
						</div>
=======
						<select class="select2" id="kota_tujuan"></select>
>>>>>>> parent of fe21324... surat jalan part 1
					</div>
					</div>
					{{csrf_field()}}
<<<<<<< HEAD
<<<<<<< HEAD
					<table id="table-sm" class="table table-bordered table-hover table-sm">
				<thead>
				<tr>
					<th rowspan="2" class="text-center">No.Resi</th>
					<th rowspan="2" class="text-center">Pengirim</th>
					<th rowspan="2" class="text-center">Penerima</th>
					<th rowspan="2" class="text-center">Tujuan</th>
					<th colspan="2" class="text-center">Jumlah</th>
					<th rowspan="2" class="text-center">Isi Paket</th>
				</tr>
				<tr>
					<th class="text-center">Koli</th>
					<th class="text-center">Kg</th>
				</tr>
				</thead>
				<tbody>
				
				
				</tbody>
			</table>
			<hr>
=======
>>>>>>> parent of a226352... surat jalan part 2 + db baru
=======
>>>>>>> parent of 591ea06... Merge remote-tracking branch 'origin/master'
					<small class="text-muted">
								<button class="btn btn-success" type="button" id="btncetak"> Cetak</button>
								<button class="btn btn-primary" type="button" id="btnsimpan"> Simpan & Selesai</button>
								
								<a onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</a>
					</small>
				</form>
			</div>
		
		</div>

	</div>
        @endsection
@section('js')

<script src="{{asset('assets/js/lib/notie/notie.js')}}"></script>
<script src="{{asset('assets/js/lib/notie/notie-init.js')}}"></script>
<!-- <script src="{{asset('assets/js/resi.js')}}"></script> -->

@endsection
@section('otherjs')
<script type="text/javascript">
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

</script>
@endsection