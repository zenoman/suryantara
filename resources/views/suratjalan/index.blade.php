@extends('layout.masteradmin')
@section('css')
<meta name="_token" content="{{ csrf_token() }}"/>
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
								<input type="text" class="form-control" id="tujuan_sj" autofocus>
							</div>
						</div>
					</div>
					</div>
					<hr>
					<div class="form-group row">
					<div class="col-md-4 col-sm-6">
						<label class="form-label" for="exampleInputDisabled">No.Resi</label>
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
								<input type="text" class="form-control" id="tujuan">
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Isi Paket</label>
							<div class="input-group">
								<input type="text" class="form-control" id="isipaket">
								<span class="input-group-btn"><button class="btn btn-info bootstrap-touchspin-up" type="button" id="btntambah">tambah</button></span>
							</div>
						</div>
					</div>
					</div>
					{{csrf_field()}}
					<table id="table-sm" class="table table-bordered table-hover table-sm">
				<thead>
				<tr>
					<th rowspan="2" class="text-center">No.Resi</th>
					<th rowspan="2" class="text-center">Pengirim</th>
					<th rowspan="2" class="text-center">Penerima</th>
					<th rowspan="2" class="text-center">Tujuan</th>
					<th colspan="2" class="text-center">Jumlah</th>
					<th rowspan="2" class="text-center">Isi Paket</th>
					<th rowspan="2">#</th>
				</tr>
				<tr>
					<th class="text-center">Koli</th>
					<th class="text-center">Kg</th>
				</tr>
				</thead>
				<tbody id="tubuh">
				
				
				</tbody>
				<tfoot>
				<tr>
					<th colspan="4" class="text-center">Sub Total</th>
					<th class="text-center" id="totaljumlah">-</th>
					<th class="text-center" id="totalkg">-</th>
					<th colspan="2" class="text-center">&nbsp;</th>
				</tr>
				<tr>
					<th colspan="4" class="text-center">Grand Total</th>
					<th class="text-center">-</th>
					<th class="text-center">-</th>
					<th colspan="2" class="text-center">&nbsp;</th>
				</tr>
				</tfoot>
			</table>
			<hr>
					<small class="text-muted">
								<button class="btn btn-success" type="button" id="btncetak"> Cetak</button>
								<button class="btn btn-primary" type="button" id="btnsimpan"> Simpan & Selesai</button>
								
								<a onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</a>
					</small>
				</form>
			</div>
		
		</div>

	</div>
<div id="hidden_div" style="display: none;">

	<h2 align="center">
		SURAT JALAN
		<br>	
		<span style="font-size: 18;margin-bottom: 20px;">CV. SURYANTARA CARGO</span>
		<br>	
		<span style="font-size: 15;">JLN RAYA DADAPAN, SUMBEREJO, NGASEM, KEDIRI</span>
	</h2>
	<table>
		<tr>
			<td>No</td>
			<td id="cetak_kodesj"></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>:&nbsp;{{date('d-m-Y')}}</td>
		</tr>
		<tr>
			<td>Tujuan</td>
			<td id="cetak_tujuan"></td>
		</tr>
	</table>
	<table border="1" width="100%;" style="border-collapse:collapse;border: 1px solid black;">
		<thead>
			<tr align="center">
			<td rowspan="2">No</td>
			<td rowspan="2">No. Resi</td>
			<td rowspan="2">Pengirim</td>
			<td rowspan="2">Penerima</td>
			<td rowspan="2">Tujuan</td>
			<td colspan="2">Jumlah</td>
			<td rowspan="2">Isi Paket</td>
			<td colspan="3"> Biaya</td>
			<td rowspan="2">Ket</td>
		</tr>
		<tr align="center">
			<td>Koli</td>
			<td>Kg</td>
			<td>Cash</td>
			<td>BT</td>
			<td>BL</td>
		</tr>
		</thead>
		
		<tbody  id="list_cetak">
			
		</tbody>
		<tfoot>
		<tr>
			<td colspan="5" align="right"><b>Sub Total</b></td>
			<td id="cetak_subtotaljumlah"></td>
			<td id="cetak_subtotalberat"></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="5" align="right"><b>Grand Total</b></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		</tfoot>
	</table>
	<br>
	<table width="100%;">
		<tr align="center">
			<td>
				<p>Diserahkan Oleh</p>
				<br>
				<p>Koordinat Cabang Asal</p>
			</td>
			<td>
				<p>Diantar Oleh</p>
				<br>
				<p>Sopir</p>
			</td>
			<td>
				<p>Diterima Oleh</p>
				<br>
				<p>Koordinat Cabang Tujuan</p>
			</td>
		</tr>
	</table>
</div>
        @endsection
@section('js')
<script src="{{asset('assets/js/lib/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/lib/notie/notie.js')}}"></script>
<script src="{{asset('assets/js/lib/notie/notie-init.js')}}"></script>


@endsection
@section('otherjs')
<script src="{{asset('assets/js/surat_jalan.js')}}"></script>
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