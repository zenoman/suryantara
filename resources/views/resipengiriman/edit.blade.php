@extends('layout.masteradmin')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/lib/ladda-button/ladda-themeless.min.css')}}">
@endsection
@section('content')
<script type="text/javascript">
     function isNumberKey(evt)
      {var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

        return true;
      }
       function isNumberKey2(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</script>
<div class="page-content" id="printdiv">
@foreach($data as $row)
<div class="container-fluid">
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Ubah Resi Manual</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
			
			<div class="form-group row">
				<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">No. Resi</label>
							<div class="input-group">
								<input type="text" class="form-control" value="{{$row->no_resi}}" readonly id="koderesinya">
							</div>
						</div>
					</div>
				<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Pembuat</label>
							<div class="input-group">
								<input type="text" class="form-control" value="{{$row->admin}}" readonly>
								
							</div>
						</div>
					</div>
					<input type="hidden" value="{{Session::get('username')}}" id="iduser">
					<input type="hidden" value="{{$row->id}}" id="idresi">
					{{csrf_field()}}
			<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Jalur Pengiriman</label>
							<div class="input-group">
								<select class="form-control" id="metode">
								<option value="darat" @if($row->pengiriman_via=='darat')selected @endif>Jalur Darat</option>
								<option value="laut" @if($row->pengiriman_via=='laut')selected @endif>Jalur Laut</option>
								<option value="udara" @if($row->pengiriman_via=='udara')selected @endif>Jalur Udara</option>
							</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-typical box-typical-padding" id="formdarat" @if($row->pengiriman_via!='darat')style="display: none;" @endif>
				<header class="card-header card-header-xl">
					Jalur Darat
				</header>
				<br>
				<div class="form-group row">
					<div class="col-md-9 col-sm-9">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nama / Isi Barang</label>
							<div class="input-group">
								<input type="text" class="form-control" id="nama_barang_darat" @if($row->pengiriman_via=='darat')value="{{$row->nama_barang}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Metode Bayar</label>
							<div class="input-group">
							<select class="form-control" id="metode_darat">
								<option value="cash" @if($row->pengiriman_via=='darat')
									@if($row->metode_bayar=='cash')selected
									@endif
								@endif>cash</option>
								<option value="bt" @if($row->pengiriman_via=='darat')
									@if($row->metode_bayar=='bt')selected
									@endif
								@endif>BT</option>
							</select>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						@php
						if($row->pengiriman_via=='darat'){
						$dimensi = $row->dimensi;
						$dmn = preg_split('/ x /',$dimensi,-1,PREG_SPLIT_NO_EMPTY);
						}
						@endphp
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Dimensi Dalam Satuan CM (P, L, T)  </label>
							<div class="input-group">
								<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_panjang_darat" @if($row->pengiriman_via=='darat') 
								value="{{$dmn[0]}}"
								@else
								value="0"
								@endif>&nbsp;
								<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_lebar_darat" @if($row->pengiriman_via=='darat') 
								value="{{$dmn[1]}}"
								@else
								value="0"
								@endif>&nbsp;
								<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_tinggi_darat" @if($row->pengiriman_via=='darat') 
								value="{{$dmn[2]}}"
								@else
								value="0"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Berat Volumetrik</label>
							<div class="input-group">
								<input type="text" class="form-control" id="volume_darat" onkeypress="return isNumberKey2(event)" @if($row->pengiriman_via=='darat') 
								value="{{$row->ukuran_volume}}"
								@else
								value="0"
								@endif>
								<div class="input-group-addon">Kg</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Jumlah</label>
							<div class="input-group">
								<input type="text" class="form-control" id="jumlah_darat" onkeypress="return isNumberKey(event)" @if($row->pengiriman_via=='darat')value="{{$row->jumlah}}"
								@endif>
								<select class="form-control" id="satuan_darat">
								<option value="kg" @if($row->pengiriman_via=='darat')
									@if($row->satuan=='kg')selected
									@endif
								@endif>&nbsp;</option>
								<option value="koli" @if($row->pengiriman_via=='darat')
									@if($row->satuan=='koli')selected
									@endif
								@endif>koli</option>
							</select>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Berat Aktual</label>
							<div class="input-group">
								<input type="text" class="form-control" id="berat_darat" onkeypress="return isNumberKey2(event)" @if($row->pengiriman_via=='darat')value="{{$row->berat}}"
								@endif>
								<div class="input-group-addon">Kg</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Kota Asal</label>
							<div class="input-group">
								<input type="text" class="form-control" id="kota_asal_darat" @if($row->pengiriman_via=='darat')value="{{$row->kota_asal}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<label class="form-label" for="exampleInputDisabled">Kota Tujuan</label>
						<select class="select2" id="kota_tujuan_darat">
							@if($row->pengiriman_via=='darat')
						<option value="{{$row->kode_tujuan}}">{{$row->kode_tujuan}}</option>
						@endif
						</select>
					</div>
					</div>
					<hr>
					<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nama Pengirim</label>
							<div class="input-group">
								<input type="text" class="form-control" id="n_pengirim_darat" @if($row->pengiriman_via=='darat')value="{{$row->nama_pengirim}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Telfon Pengirim</label>
							<div class="input-group">
								<input type="text" onkeypress="return isNumberKey(event)" class="form-control" id="t_pengirim_darat" @if($row->pengiriman_via=='darat')value="{{$row->telp_pengirim}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Alamat Pengirim</label>
							<div class="input-group">
								<input type="text" class="form-control" id="alamat_pengirim_darat" @if($row->pengiriman_via=='darat')value="{{$row->alamat_pengirim}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nama Penerima</label>
							<div class="input-group">
								<input type="text" class="form-control" id="n_penerima_darat" @if($row->pengiriman_via=='darat')value="{{$row->nama_penerima}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Telfon Penerima</label>
							<div class="input-group">
								<input type="text" onkeypress="return isNumberKey(event)" class="form-control" id="t_penerima_darat" @if($row->pengiriman_via=='darat')value="{{$row->telp_penerima}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Alamat Penerima</label>
							<div class="input-group">
								<input type="text" class="form-control" id="alamat_penerima_darat" @if($row->pengiriman_via=='darat')value="{{$row->alamat_penerima}}"
								@endif>
							</div>
						</div>
					</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-7 col-md-7">
						<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya Kirim</label>
							<div class="input-group">
								<input type="text" class="form-control" id="biaya_kirim_darat" onkeypress="return isNumberKey(event)" @if($row->pengiriman_via=='darat')value="{{$row->biaya_kirim}}"
								@else
								value="0" 
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya Packing</label>
							<div class="input-group">
								<input type="text" class="form-control" id="biaya_packing_darat" onkeypress="return isNumberKey(event)" @if($row->pengiriman_via=='darat')value="{{$row->biaya_packing}}"
								@else
								value="0" 
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya Asuransi</label>
							<div class="input-group">
								<input type="text" class="form-control" id="biaya_asuransi_darat" onkeypress="return isNumberKey(event)" @if($row->pengiriman_via=='darat')value="{{$row->biaya_asuransi}}"
								@else
								value="0" 
								@endif>
							</div>
						</div>
					</div>
						</div>
						<div class="col-md-5 col-sm-5">
							<table class="table table-bordered" id="estimasi">
								<thead>
									<tr>
										<th colspan="2" class="text-center">Estimasi Biaya</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Biaya Kirim</td>
										<td id="b_kirim_darat">@if($row->pengiriman_via=='darat'){{$row->biaya_kirim}}
										@else
										0		 
										@endif
										</td>
									</tr>
									<tr>
										<td>Biaya Packing</td>
										<td id="b_packing_darat">@if($row->pengiriman_via=='darat'){{$row->biaya_packing}}
										@else
										0		 
										@endif</td>
									</tr>
									<tr>
										<td>Biaya Asuransi</td>
										<td id="b_asuransi_darat">@if($row->pengiriman_via=='darat'){{$row->biaya_asuransi}}
										@else
										0		 
										@endif</td>
									</tr>
									
									<tr>
										<td colspan="2" class="text-center">
											<h3 id="total_darat">@if($row->pengiriman_via=='darat'){{$row->total_biaya}}
										@else
										0		 
										@endif</h3>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Keterangan</label>
							<div class="input-group">
								<textarea rows="4" class="form-control" id="keterangan_darat">
									@if($row->pengiriman_via=='darat'){{$row->keterangan}}
									@endif
								</textarea>
							</div>
						</div>
					</div>
					</div>
							<small class="text-muted">
								<button class="btn btn-primary ladda-button" data-style="zoom-out" id="btnsimpan_darat" type="button"><span class="ladda-label">Simpan & Cetak</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
								</button>

								<div class="pull-right">
									<button class="btn btn-success btnselesai">
										Selesai
									</button>
									&nbsp;
									<a onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</a>
								</div>
								
							</small>
			</div>
			<div class="box-typical box-typical-padding" id="formlaut" @if($row->pengiriman_via!='laut')style="display: none;" @endif>
				<header class="card-header card-header-xl">
					Jalur Laut
				</header>
				<br>
			<div class="form-group row">
						
						<div class="col-md-9 col-sm-9">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nama / Isi Barang</label>
							<div class="input-group">
								<input type="text" class="form-control" id="nama_barang_laut" @if($row->pengiriman_via=='laut')value="{{$row->nama_barang}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Metode Bayar</label>
							<div class="input-group">
								<select class="form-control" id="metode_laut">
								<option value="cash" @if($row->pengiriman_via=='laut')
									@if($row->metode_bayar=='cash')selected
									@endif
								@endif>cash</option>
								<option value="bt"
								@if($row->pengiriman_via=='laut')
									@if($row->metode_bayar=='bt')selected
									@endif
								@endif>BT</option>
							</select>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						@php
						if($row->pengiriman_via=='laut'){
						$dimensi = $row->dimensi;
						$dmn = preg_split('/ x /',$dimensi,-1,PREG_SPLIT_NO_EMPTY);
						}
						@endphp
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Dimensi Dalam Satuan CM (P, L, T)  </label>
							<div class="input-group">
								<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_panjang_laut" @if($row->pengiriman_via=='laut') 
								value="{{$dmn[0]}}"
								@else
								value="0"
								@endif>&nbsp;
								<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_lebar_laut" @if($row->pengiriman_via=='laut') 
								value="{{$dmn[1]}}"
								@else
								value="0"
								@endif>&nbsp;
								<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_tinggi_laut" @if($row->pengiriman_via=='laut') 
								value="{{$dmn[2]}}"
								@else
								value="0"
								@endif>
									
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Berat Volumetrik</label>
							<div class="input-group">
								<input type="text" class="form-control" id="volume_laut" onkeypress="return isNumberKey2(event)" @if($row->pengiriman_via=='laut') 
								value="{{$row->ukuran_volume}}"
								@else
								value="0"
								@endif>
								<div class="input-group-addon">Kg</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Jumlah</label>
							<div class="input-group">
								<input type="text" class="form-control" id="jumlah_laut" onkeypress="return isNumberKey(event)" @if($row->pengiriman_via=='laut')value="{{$row->jumlah}}"
								@endif>
								<select class="form-control" id="satuan_laut">
								<option value="kg" @if($row->pengiriman_via=='laut')
									@if($row->satuan=='kg')selected
									@endif
								@endif>&nbsp;</option>
								<option value="koli"
								@if($row->pengiriman_via)
									@if($row->satuan=='koli')
										selected
									@endif
								@endif>koli</option>
							</select>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Berat Aktual</label>
							<div class="input-group">
								<input type="text" class="form-control" id="berat_laut" onkeypress="return isNumberKey2(event)" @if($row->pengiriman_via=='laut')
								value="{{$row->berat}}"
								@endif>
								<div class="input-group-addon">Kg</div>
							</div>
						</div>
						
					</div>

					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Kota Asal</label>
							<div class="input-group">
								<input type="text" class="form-control" id="kota_asal_laut" @if($row->pengiriman_via=='laut')
								value="{{$row->kota_asal}}"
								@endif>
							</div>
						</div>
					</div>

					<div class="col-md-4 col-sm-6">
						<label class="form-label" for="exampleInputDisabled">Kota Tujuan</label>
						<select class="select2" id="kota_tujuan_laut">
							@if($row->pengiriman_via=='laut')
							<option>{{$row->kode_tujuan}}</option>
							@endif
						</select>
					</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nama Pengirim</label>
							<div class="input-group">
								<input type="text" class="form-control" id="n_pengirim_laut" @if($row->pengiriman_via=='laut')
								value="{{$row->nama_pengirim}}" 
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Telfon Pengirim</label>
							<div class="input-group">
								<input type="text" onkeypress="return isNumberKey(event)" class="form-control" id="t_pengirim_laut"  @if($row->pengiriman_via=='laut')value="{{$row->telp_pengirim}}" @endif>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Alamat Pengirim</label>
							<div class="input-group">
								<input type="text" class="form-control" id="alamat_pengirim_laut" @if($row->pengiriman_via=='laut') value="{{$row->alamat_pengirim}}" @endif>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nama Penerima</label>
							<div class="input-group">
								<input type="text" class="form-control" id="n_penerima_laut" @if($row->pengiriman_via=='laut')value="{{$row->nama_pengirim}}"@endif>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Telfon Penerima</label>
							<div class="input-group">
								<input type="text" onkeypress="return isNumberKey(event)" class="form-control" id="t_penerima_laut" @if($row->pengiriman_via=='laut') value="{{$row->telp_penerima}}" @endif >
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Alamat Penerima</label>
							<div class="input-group">
								<input type="text" class="form-control" id="alamat_penerima_laut" @if($row->pengiriman_via=='laut') value="{{$row->alamat_penerima}}" @endif>
							</div>
						</div>
					</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-7 col-md-7">
						<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya Kirim</label>
							<div class="input-group">
								<input type="text" class="form-control" id="biaya_kirim_laut" onkeypress="return isNumberKey(event)" @if($row->pengiriman_via=='laut') value="{{$row->biaya_kirim}}" @endif>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya Packing</label>
							<div class="input-group">
								<input type="text" class="form-control" id="biaya_packing_laut" onkeypress="return isNumberKey(event)" @if($row->pengiriman_via=='laut')value="{{$row->biaya_packing}}" @endif>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya Asuransi</label>
							<div class="input-group">
								<input type="text" class="form-control" id="biaya_asuransi_laut" onkeypress="return isNumberKey(event)" @if($row->pengiriman_via=='laut')value="{{$row->biaya_asuransi}}" @endif>
							</div>
						</div>
					</div>
						</div>
						<div class="col-md-5 col-sm-5">
							<table class="table table-bordered" id="estimasi">
								<thead>
									<tr>
										<th colspan="2" class="text-center">Estimasi Biaya</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Biaya Kirim</td>
										<td id="b_kirim_laut">@if($row->pengiriman_via=='laut'){{$row->biaya_kirim}}
										@else
										0 
										@endif</td>
									</tr>
									<tr>
										<td>Biaya Packing</td>
										<td id="b_packing_laut">@if($row->pengiriman_via=='laut'){{$row->biaya_packing}}
										@else
										0 
										@endif</td>
									</tr>
									<tr>
										<td>Biaya Asuransi</td>
										<td id="b_asuransi_laut">@if($row->pengiriman_via=='laut'){{$row->biaya_asuransi}}
										@else
										0 
										@endif</td>
									</tr>
									
									<tr>
										<td colspan="2" class="text-center">
											<h3 id="total_laut">@if($row->pengiriman_via=='laut'){{$row->total_biaya}}
										@else
										0 
										@endif</h3>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Keterangan</label>
							<div class="input-group">
								<textarea rows="4" class="form-control" id="keterangan_laut">
									@if($row->pengiriman_via=='laut'){!!$row->keterangan!!}
								@endif
								</textarea>
							</div>
						</div>
					</div>
					</div>
							<small class="text-muted">
								<button class="btn btn-primary ladda-button" data-style="zoom-out" id="btnsimpan_laut" type="button"><span class="ladda-label">Simpan & Selesai</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
								</button>
								<div class="pull-right">
									<button class="btn btn-success btnselesai">
										Selesai
									</button>
									&nbsp;
									<a onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</a>
								</div>
								
								
							</small>
			</div>




<!-- ================================================================= -->
			<div class="box-typical box-typical-padding" id="formudara" @if($row->pengiriman_via!='udara')style="display: none;" @endif>
			<header class="card-header card-header-xl">
					Jalur Udara
				</header>
				<br>
					<div class="form-group row">
						
						<div class="col-md-8 col-sm-8">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nama / Isi Barang</label>
							<div class="input-group">
								<input type="text" class="form-control" id="nama_barang_udara"
								@if($row->pengiriman_via=='udara')value="{{$row->nama_barang}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Kategori barang</label>
							<div class="input-group">
								<select class="form-control" id="kategori_udara">
								<option value="biasa"></option>
								@foreach($kategori as $kat)
								<option value="{{$kat->charge}}">{{$kat->spesial_cargo}} ({{$kat->charge}}%)</option>
								@endforeach
							</select>
							</div>
						</div>
					</div>
					
					<div class="col-md-4 col-sm-6">
						@php
						if($row->pengiriman_via=='udara'){
						$dimensi = $row->dimensi;
							if($dimensi!='-'){
								$dmn = preg_split('/ x /',$dimensi,-1,PREG_SPLIT_NO_EMPTY);
							}
						
						}
						@endphp
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Dimensi Dalam Satuan <b>cm</b> (P, L, T)  </label>
							<div class="input-group">
								<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_panjang_udara1" @if($dimensi!='-')value="{{$dmn[0]}}" @else value="0"@endif>&nbsp;
								<input type="text" onkeypress="return isNumberKey(event)" onchange="hayy(1)" class="col-sm-4 col-md-4 form-control" id="d_lebar_udara1" onchange="hayy(1)" @if($dimensi!='-')value="{{$dmn[1]}}" @else value="0"@endif>&nbsp;
								<input type="text" onkeypress="return isNumberKey(event)" onchange="hayy(1)" class="col-sm-4 col-md-4 form-control" id="d_tinggi_udara1" @if($dimensi!='-')value="{{$dmn[2]}}" @else value="0"@endif>
									
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Berat Volumetrik</label>
							<div class="input-group">
								<input type="text" class="form-control" id="volume_udara1" onkeypress="return isNumberKey2(event)" onchange="hitungberat()" @if($row->pengiriman_via=='udara')
									@if($row->ukuran_volume!='-')
										value="{{$row->ukuran_volume}}"
									@else
									  value="0"
									@endif
								@endif>
								<div class="input-group-addon">Kg</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Berat Aktual</label>
							<div class="input-group">
								<input type="text" class="form-control" id="berat_udara1" onkeypress="return isNumberKey2(event)" onchange="hitungberat()"  @if($row->pengiriman_via=='udara')
									@if($row->ukuran_volume!='-')
										value="{{$row->berat}}"
									@else
									  value="0"
									@endif
								@endif>
								<div class="input-group-addon">Kg</div>
							</div>
						</div>
						
					</div>
					</div>
					<div id="kolomjumlah">
					
				</div>

				<div class="row">
					<div class="col-md-3 col-sm-3">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Metode Bayar</label>
							<div class="input-group">
								<select class="form-control" id="metode_udara">
								<option value="cash"
								@if($row->pengiriman_via=='udara')
									@if($row->metode_bayar=='cash')selected
									@endif
								@endif>cash</option>
								<option value="bt"
								@if($row->pengiriman_via=='udara')
									@if($row->metode_bayar=='bt')selected
									@endif
								@endif>BT</option>
							</select>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Jumlah</label>
							<div class="input-group">
								<input type="text" class="form-control" id="jumlah_udara" onkeypress="return isNumberKey(event)" readonly @if($row->pengiriman_via=='udara')value="{{$row->jumlah}}" @else value="1"
								@endif>
								<select class="form-control" id="satuan_udara">
								<option 
								value="kg"
								@if($row->pengiriman_via=='udara')
									@if($row->metode_bayar=='kg')selected
									@endif
								@endif>&nbsp;</option>
								<option value="koli"
								@if($row->pengiriman_via=='udara')
									@if($row->metode_bayar=='koli')selected
									@endif
								@endif>koli</option>
							</select>
							</div>
						</div>
					</div>
					
					<div class="col-md-3 col-sm-3">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Berat Total</label>
							<div class="input-group">
								<input type="text" class="form-control" id="totalberat" readonly @if($row->pengiriman_via=='udara')value="{{$row->berat}}" @else value="0"
								@endif>
								<div class="input-group-addon">Kg</div>
							</div>
						</div>
					</div>
					<div class="col-md-1 col-sm-1">
							<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">&nbsp;</label>
							<div class="input-group">
							<button type="button" id="tambahjumlah" class="btn btn-warning"> Tambah Jumlah</button>
								</div>
							</div>
						</div>
					<p id="msgheavy" class="text-danger"></p>
					</div>
					<hr>
					<div class="row">
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Kota Asal</label>
							<div class="input-group">
								<input type="text" class="form-control" id="kota_asal_udara" @if($row->pengiriman_via=='udara')value="{{$row->kota_asal}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-8 col-sm-8">
						<label class="form-label" for="exampleInputDisabled">Kota Tujuan</label>
						<select class="select2" id="kota_tujuan_udara">
						@if($row->pengiriman_via=='udara')
						<option value="{{$row->kode_tujuan}}">{{$row->kode_tujuan}}</option>
						@endif
						</select>
						<input type="hidden" id="kta_tujuan_udara" @if($row->pengiriman_via=='udara')value="{{$row->kode_tujuan}}"@endif>
					</div>
					<div class="col-md-3 col-sm-3">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya Per<b>Kg</b></label>
							<div class="input-group">
								<div class="input-group-addon">Rp. </div>
								<input type="text" class="form-control" id="bpk" value="0" readonly>
								
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Min. Heavy Cargo</label>
							<div class="input-group">
								<input type="text" class="form-control" id="min_heavy" readonly value="0">
								<div class="input-group-addon">Kg</div>
							</div>
						</div>
						
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nomer SMU (Boleh Kosong)</label>
							<div class="input-group">
								<input type="text" class="form-control" id="nomer_smu_udara" @if($row->pengiriman_via=='udara')value="{{$row->no_smu}}"
								@endif>
							</div>
						</div>
					</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nama Pengirim</label>
							<div class="input-group">
								<input type="text" class="form-control" id="n_pengirim_udara" @if($row->pengiriman_via=='udara')value="{{$row->nama_pengirim}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Telfon Pengirim</label>
							<div class="input-group">
								<input type="text" onkeypress="return isNumberKey(event)" class="form-control" id="t_pengirim_udara" @if($row->pengiriman_via=='udara')value="{{$row->telp_pengirim}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Alamat Pengirim</label>
							<div class="input-group">
								<input type="text" class="form-control" id="alamat_pengirim_udara" @if($row->pengiriman_via=='udara')value="{{$row->alamat_pengirim}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Nama Penerima</label>
							<div class="input-group">
								<input type="text" class="form-control" id="n_penerima_udara" @if($row->pengiriman_via=='udara')value="{{$row->nama_penerima}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Telfon Penerima</label>
							<div class="input-group">
								<input type="text" onkeypress="return isNumberKey(event)" class="form-control" id="t_penerima_udara" @if($row->pengiriman_via=='udara')value="{{$row->telp_penerima}}"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Alamat Penerima</label>
							<div class="input-group">
								<input type="text" class="form-control" id="alamat_penerima_udara" @if($row->pengiriman_via=='udara')value="{{$row->alamat_penerima}}"
								@endif>
							</div>
						</div>
					</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-7 col-md-7">
						<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya Kirim</label>
							<div class="input-group">
								<input type="text" class="form-control" id="biaya_kirim_udara" onkeypress="return isNumberKey(event)" @if($row->pengiriman_via=='udara')value="{{$row->biaya_kirim}}"
								@else
								value="0"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya SMU</label>
							<div class="input-group">
								<input type="text" class="form-control" id="biaya_smu_udara" onkeypress="return isNumberKey(event)" @if($row->pengiriman_via=='udara')value="{{$row->biaya_smu}}"
								@else
								value="0"
								@endif>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Biaya Karantina</label>
							<div class="input-group">
								<input type="text" class="form-control" id="biaya_karantina_udara" onkeypress="return isNumberKey(event)" @if($row->pengiriman_via=='udara')value="{{$row->biaya_karantina}}"
								@else
								value="0"
								@endif>
							</div>
						</div>
					</div>
						</div>
						<div class="col-md-5 col-sm-5">
							<table class="table table-bordered" id="estimasi">
								<thead>
									<tr>
										<th colspan="2" class="text-center">Estimasi Biaya</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Biaya Kirim</td>
										<td id="b_kirim_udara">@if($row->pengiriman_via=='udara'){{$row->biaya_kirim}}
										@else
										0
										@endif
									</td>
									</tr>
									<tr>
										<td>Biaya SMU</td>
										<td id="b_smu_udara">@if($row->pengiriman_via=='udara'){{$row->biaya_smu}}
										@else
										0
										@endif</td>
									</tr>
									<tr>
										<td>Biaya Karantina</td>
										<td id="b_karantina_udara">
											@if($row->pengiriman_via=='udara'){{$row->biaya_karantina}}
										@else
										0
										@endif
										</td>
									</tr>
									
									<tr>
										<td>Charge</td>
										<td id="b_charge_udara">@if($row->pengiriman_via=='udara'){{$row->biaya_charge}}
										@else
										0
										@endif</td>
									</tr>
									<tr>
										<td colspan="2" class="text-center">
											<h3 id="total_udara">@if($row->pengiriman_via=='udara'){{$row->total_biaya}}
										@else
										0
										@endif</h3>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Keterangan</label>
							<div class="input-group">
								<textarea rows="4" class="form-control" id="keterangan_udara">
									@if($row->pengiriman_via=='udara'){{$row->keterangan}}
										
										@endif
								</textarea>
							</div>
						</div>
					</div>
					</div>
							<small class="text-muted">
								<button class="btn btn-primary ladda-button" data-style="zoom-out" id="btnsimpan_udara"><span class="ladda-label">Simpan & Cetak</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
								</button>

								<div class="pull-right">
									<button class="btn btn-success btnselesai">
										Selesai
									</button>
									&nbsp;
									<a onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</a>
								</div>
								
							</small>
			</div>
	<div id="hidden_div" style="display: none;">
     <div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center" >
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35% " align="right" id="cetak_resi"></p> 
								<p style="margin-left: 35% " align="right" id="cetak_pengiriman_via"></p> 
								<p style="margin-right: 7px;" align="right">Tanggal : <?php echo date('d-m-Y');?></p> 
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 100%;border-collapse:collapse;border: 1px solid black;">
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Pengirim</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Deskripsi</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Syarat-syarat</td>
				
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_pengirim" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_pengirim" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_pengirim" align="left"></td>
						</tr>
					</table>
				</td>
				<td rowspan="3" style="border: 1px solid black;">
					<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
					<td>
						<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
							<td style="width: 25%;font-size: 10;">Isi Paket</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_isi_paket"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Jumlah</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_jumlah_barang"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Metode</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" >
								<b>
									<span id="cetak_metode"></span>
								</b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Kota asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_asal"></span>
											</b>
										</td>
										<td style="font-size: 11;">Tujuan&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_tujuan"></span>
											</b>
										</td>
									</tr>
								</table>
							</td>
							<td></td>
						</tr>
					</table>
					</td>
						</tr>
				<tr>
					<td style="width:40%;">
					<table style="width: 100%;border-collapse:collapse; font-size: 6;" border="1">
						<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid black; border-bottom: 1px solid black;" align="center" id="cetak_dimensi"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_volumetrik"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_berat"></td>
						</tr>
					</table>
				</td>
				</tr>
						<tr>
					<td>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_kirim"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Packing</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_packing"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Asuransi</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_asu"></td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b id="cetak_total"></b>
							</td>
						</tr>
					</table>
					</td>
				</tr>
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 8;padding-left: 10px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol>
				</td>
			</tr>
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Penerima</td>
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_penerima" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_penerima" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_penerima" align="left"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 35%;">
							<p style="margin-left: 1%;margin-right: 1%;font-size: 10;">
							Pengirim dengan ini menyatakan bahwa keterangan yang ada pada resi ini benar dan telah memenuhi syarat.
							</p>
							<br>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
							<td style="border-left: 1px solid black; width: 30%;">
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal"></p>
									<br>
									<p align="center" style="font-size: 9">Tanda Tangan Petugas</p>
							
							</td>
							<td style="border-left: 1px solid black; width: 35%;">
								<p style="font-size: 10;margin-left: 1%;">Penerima telah menerima barang dalam keadaan baik pada <br><br>
									Tanggal&nbsp;&nbsp;:........................................ 
									<br><br>								Jam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:........................................
								</p>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
			</tr>
		</table>
	</div>
	<p style="font-size: 10;">pengirim</p>
	<hr>
	<!-- ================================================ -->	
	<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center" >
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35% " align="right" id="cetak_resi2"></p> 
								<p style="margin-left: 35% " align="right" id="cetak_pengiriman_via2"></p>  
								<p style="margin-right: 7px;" align="right">Tanggal : <?php echo date('d-m-Y');?></p> 
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 100%;border-collapse:collapse;border: 1px solid black;">
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Pengirim</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Deskripsi</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Syarat-syarat</td>
				
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_pengirim2" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_pengirim2" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_pengirim2" align="left"></td>
						</tr>
					</table>
				</td>
				<td rowspan="3" style="border: 1px solid black;">
					<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
					<td>
						<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
							<td style="width: 25%;font-size: 10;">Isi Paket</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_isi_paket2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Jumlah</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_jumlah_barang2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Metode</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;">
								<b><span  id="cetak_metode2">
									
								</span></b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Kota asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b><span id="cetak_kota_asal2" ></span></b>
										</td>
										<td style="font-size: 11;">Tujuan&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_tujuan2"></span>
											</b>
										</td>
									</tr>
								</table>
							</td>
							<td></td>
						</tr>
					</table>
					</td>
						</tr>
				<tr>
					<td style="width:40%;">
					<table style="width: 100%;border-collapse:collapse; font-size: 6;" border="1">
						<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid black; border-bottom: 1px solid black;" align="center" id="cetak_dimensi2"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_volumetrik2"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_berat2"></td>
						</tr>
					</table>
				</td>
				</tr>
						<tr>
					<td>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_kirim2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Packing</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_packing2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Asuransi</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_asu2"></td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b id="cetak_total2"></b>
							</td>
						</tr>
					</table>
					</td>
				</tr>
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 8;padding-left: 10px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol>
				</td>
			</tr>
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Penerima</td>
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_penerima2" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_penerima2" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_penerima2" align="left"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 35%;">
							<p style="margin-left: 1%;margin-right: 1%;font-size: 10;">
							Pengirim dengan ini menyatakan bahwa keterangan yang ada pada resi ini benar dan telah memenuhi syarat.
							</p>
							<br>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
							<td style="border-left: 1px solid black; width: 30%;">
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal2"></p>
									<br>
									<p align="center" style="font-size: 9">Tanda Tangan Petugas</p>
							
							</td>
							<td style="border-left: 1px solid black; width: 35%;">
								<p style="font-size: 10;margin-left: 1%;">Penerima telah menerima barang dalam keadaan baik pada <br><br>
									Tanggal&nbsp;&nbsp;:........................................ 
									<br><br>								Jam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:........................................
								</p>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
			</tr>
		</table>
	</div>
	<p style="font-size: 10;">asal</p>
	<hr>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<!-- ================================================= -->
	<hr>
	<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center" >
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35% " align="right" id="cetak_resi3"></p> 
								<p style="margin-left: 35% " align="right" id="cetak_pengiriman_via3"></p> 
								<p style="margin-right: 7px;" align="right">Tanggal : <?php echo date('d-m-Y');?></p> 
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 100%;border-collapse:collapse;border: 1px solid black;">
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Pengirim</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Deskripsi</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Syarat-syarat</td>
				
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_pengirim3" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_pengirim3" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_pengirim3" align="left"></td>
						</tr>
					</table>
				</td>
				<td rowspan="3" style="border: 1px solid black;">
					<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
					<td>
						<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
							<td style="width: 25%;font-size: 10;">Isi Paket</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_isi_paket3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Jumlah</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_jumlah_barang3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Metode</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;">
								<b><span id="cetak_metode3">
									
								</span></b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Kota asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_asal3">
												</span>
											</b>
										</td>
										<td style="font-size: 11;">Tujuan&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_tujuan3">
												</span>
											</b>
										</td>
									</tr>
								</table>
							</td>
							<td></td>
						</tr>
					</table>
					</td>
						</tr>
				<tr>
					<td style="width:40%;">
					<table style="width: 100%;border-collapse:collapse; font-size: 6;" border="1">
						<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid black; border-bottom: 1px solid black;" align="center" id="cetak_dimensi3"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_volumetrik3"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_berat3"></td>
						</tr>
					</table>
				</td>
				</tr>
						<tr>
					<td>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;">-</td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Packing</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;">-</td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Asuransi</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;">-</td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b>-</b>
							</td>
						</tr>
					</table>
					</td>
				</tr>
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 8;padding-left: 10px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol>
				</td>
			</tr>
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Penerima</td>
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_penerima3" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_penerima3" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_penerima3" align="left"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 35%;">
							<p style="margin-left: 1%;margin-right: 1%;font-size: 10;">
							Pengirim dengan ini menyatakan bahwa keterangan yang ada pada resi ini benar dan telah memenuhi syarat.
							</p>
							<br>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
							<td style="border-left: 1px solid black; width: 30%;">
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal3"></p>
									<br>
									<p align="center" style="font-size: 9">Tanda Tangan Petugas</p>
							
							</td>
							<td style="border-left: 1px solid black; width: 35%;">
								<p style="font-size: 10;margin-left: 1%;">Penerima telah menerima barang dalam keadaan baik pada <br><br>
									Tanggal&nbsp;&nbsp;:........................................ 
									<br><br>								Jam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:........................................
								</p>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
			</tr>
		</table>
	</div>
	<p style="font-size: 10;">tujuan</p>
	<hr>
	<!-- ================================================= -->
	<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center" >
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35% " align="right" id="cetak_resi4"></p> 
								<p style="margin-left: 35% " align="right" id="cetak_pengiriman_via4"></p> 
								<p style="margin-right: 7px;" align="right">Tanggal : <?php echo date('d-m-Y');?></p> 
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 100%;border-collapse:collapse;border: 1px solid black;">
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Pengirim</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Deskripsi</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Syarat-syarat</td>
				
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_pengirim4" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_pengirim4" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_pengirim4" align="left"></td>
						</tr>
					</table>
				</td>
				<td rowspan="3" style="border: 1px solid black;">
					<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
					<td>
						<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
							<td style="width: 25%;font-size: 10;">Isi Paket</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_isi_paket4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Jumlah</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_jumlah_barang4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Metode</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" >
								<b><span id="cetak_metode4">
									
								</span></b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Kota asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
											<span  id="cetak_kota_asal4">
											</span>	
											</b>
											
										</td>
										<td style="font-size: 11;">Tujuan&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_tujuan4"> </span>
											</b>
										</td>
									</tr>
								</table>
							</td>
							<td></td>
						</tr>
					</table>
					</td>
						</tr>
				<tr>
					<td style="width:40%;">
					<table style="width: 100%;border-collapse:collapse; font-size: 6;" border="1">
						<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid black; border-bottom: 1px solid black;" align="center" id="cetak_dimensi4"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_volumetrik4"></td>
							<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center" id="cetak_berat4"></td>
						</tr>
					</table>
				</td>
				</tr>
						<tr>
					<td>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;">-</td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Packing</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;">-</td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Asuransi</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;">-</td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b>-</b>
							</td>
						</tr>
					</table>
					</td>
				</tr>
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 8;padding-left: 10px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol>
				</td>
			</tr>
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Penerima</td>
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_penerima4" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_penerima4" align="left"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_penerima4" align="left"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 35%;">
							<p style="margin-left: 1%;margin-right: 1%;font-size: 10;">
							Pengirim dengan ini menyatakan bahwa keterangan yang ada pada resi ini benar dan telah memenuhi syarat.
							</p>
							<br>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
							<td style="border-left: 1px solid black; width: 30%;">
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal4"></p>
									<br>
									<p align="center" style="font-size: 9">Tanda Tangan Petugas</p>
							
							</td>
							<td style="border-left: 1px solid black; width: 35%;">
								<p style="font-size: 10;margin-left: 1%;">Penerima telah menerima barang dalam keadaan baik pada <br><br>
									Tanggal&nbsp;&nbsp;:........................................ 
									<br><br>								Jam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:........................................
								</p>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
			</tr>
		</table>
	</div>
	<p style="font-size: 10;">penerima</p>
	<hr>
    </div>
    <div id="hidden_div_udara" style="display: none;">
		<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center" >
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
					<p style="margin-left: 35% " align="right" id="cetak_resi_udara"></p> 
					<p style="margin-left: 35% " align="right">Pengiriman Via : Udara</p> 
					<p style="margin-right: 7px;" align="right">Tanggal : <?php echo date('d-m-Y');?></p> 
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 100%;border-collapse:collapse;border: 1px solid black;">
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Pengirim</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Deskripsi</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Syarat-syarat</td>
				
			</tr>
			<tr>
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_pengirim_udara"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_pengirim_udara"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_pengirim_udara"></td>
						</tr>
					</table>
				</td>
				<td rowspan="3" style="border: 1px solid black;">
					<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
					<td>
						<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
							<td style="width: 25%;font-size: 10;">Isi Paket</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_isi_paket_udara"></td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;">Jumlah</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;"><span id="cetak_jumlah_barang_udara"></span></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Total Berat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_berat_udara"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.SMU</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_nosmu_udara"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Metode</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;">
								<b><span id="cetak_metode_udara"></span></b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Kota asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_asal_udara"></span>
											</b>
										</td>
										<td style="font-size: 11;">Tujuan&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_tujuan_udara"></span>
											</b>
										</td>
									</tr>
								</table>
							</td>
							<td></td>
						</tr>
					</table>
					</td>
						</tr>
				<tr>
					<td style="width:40%;">
					<table style="width: 100%;border-collapse:collapse; font-size: 7;" border="1">
						<thead>
						<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>	
						</thead>
						<tbody  id="listbarang">
							
						</tbody>
					</table>
				</td>
				</tr>
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 4; padding-left: 7px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol><hr>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_kirim_udara"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">SMU</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_smu_udara"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Karantina</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_karantina_udara"></td>
						</tr>
						
						
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Surcharge</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_charge_udara"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total Biaya</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b id="cetak_total_udara"></b>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Penerima</td>
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_penerima_udara"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_penerima_udara"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_penerima_udara"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 35%;">
							<p style="margin-left: 1%;margin-right: 1%;font-size: 10;">
							Pengirim dengan ini menyatakan bahwa keterangan yang ada pada resi ini benar dan telah memenuhi syarat.
							</p>
							<br>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
							<td style="border-left: 1px solid black; width: 30%;">
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal_udara"></p>
									<br>
									<p align="center" style="font-size: 9">Tanda Tangan Petugas</p>
							
							</td>
							<td style="border-left: 1px solid black; width: 35%;">
								<p style="font-size: 10;margin-left: 1%;">Penerima telah menerima barang dalam keadaan baik pada <br><br>
									Tanggal&nbsp;&nbsp;:........................................ 
									<br><br>								Jam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:........................................
								</p>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
			</tr>
		</table>
	</div>
	<p style="font-size: 10;">pengirim</p>
	<hr>
	<!-- ============================================== -->




	<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center" >
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35% " align="right" id="cetak_resi_udara2"></p> 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Udara</p> 
								<p style="margin-right: 7px;" align="right">Tanggal : <?php echo date('d-m-Y');?></p> 
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 100%;border-collapse:collapse;border: 1px solid black;">
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Pengirim</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Deskripsi</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Syarat-syarat</td>
				
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_pengirim_udara2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_pengirim_udara2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_pengirim_udara2"></td>
						</tr>
					</table>
				</td>
				<td rowspan="3" style="border: 1px solid black;">
					<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%; margin-left: 2%;margin-right: 2%;">
						<tr>
					<td>
						<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
							<td style="width: 25%;font-size: 10;">Isi Paket</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_isi_paket_udara2"></td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;">Jumlah</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;"><span id="cetak_jumlah_barang_udara2"></span></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Total Berat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_berat_udara2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.SMU</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_nosmu_udara2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Metode</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;">
								<b><span id="cetak_metode_udara2"></span></b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Kota asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_asal_udara2"></span>
											</b>
										</td>
										<td style="font-size: 11;">Tujuan&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_tujuan_udara2"></span>
											</b>
										</td>
									</tr>
								</table>
							</td>
							<td></td>
						</tr>
					</table>
					</td>
						</tr>
				<tr>
					<td style="width:40%;">
					<table style="width: 100%;border-collapse:collapse; font-size: 7;" border="1">
						<thead>
							<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>
						</thead>
						<tbody id="listbarang2">
							
						</tbody>
						
					</table>
				</td>
				</tr>
				
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 4; padding-left: 7px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol><hr>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_kirim_udara2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">SMU</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_smu_udara2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Karantina</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_karantina_udara2"></td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Surcharge</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_charge_udara2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total Biaya</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b id="cetak_total_udara2"></b>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Penerima</td>
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_penerima_udara2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_penerima_udara2"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_penerima_udara2"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 35%;">
							<p style="margin-left: 1%;margin-right: 1%;font-size: 10;">
							Pengirim dengan ini menyatakan bahwa keterangan yang ada pada resi ini benar dan telah memenuhi syarat.
							</p>
							<br>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
							<td style="border-left: 1px solid black; width: 30%;">
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal_udara2"></p>
									<br>
									<p align="center" style="font-size: 9">Tanda Tangan Petugas</p>
							
							</td>
							<td style="border-left: 1px solid black; width: 35%;">
								<p style="font-size: 10;margin-left: 1%;">Penerima telah menerima barang dalam keadaan baik pada <br><br>
									Tanggal&nbsp;&nbsp;:........................................ 
									<br><br>								Jam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:........................................
								</p>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
			</tr>
		</table>
	</div>
	<p style="font-size: 10;">asal</p>
	<hr>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<!-- ============================================== -->



	<hr>
	<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center" >
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35% " align="right" id="cetak_resi_udara3"></p> 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Udara</p> 
								<p style="margin-right: 7px;" align="right">Tanggal : <?php echo date('d-m-Y');?></p> 
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 100%;border-collapse:collapse;border: 1px solid black;">
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Pengirim</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Deskripsi</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Syarat-syarat</td>
				
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_pengirim_udara3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_pengirim_udara3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_pengirim_udara3"></td>
						</tr>
					</table>
				</td>
				<td rowspan="3" style="border: 1px solid black;">
					<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
					<td>
						<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
							<td style="width: 25%;font-size: 10;">Isi Paket</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_isi_paket_udara3"></td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;">Jumlah</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;"><span id="cetak_jumlah_barang_udara3"></span></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Total Berat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_berat_udara3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.SMU</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_nosmu_udara3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Metode</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;">
								<b><span id="cetak_metode_udara3"></span></b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Kota asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_asal_udara3"></span>
											</b>
										</td>
										<td style="font-size: 11;">Tujuan&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_tujuan_udara3"></span>
											</b>
										</td>
									</tr>
								</table>
							</td>
							<td></td>
						</tr>
					</table>
					</td>
						</tr>
				<tr>
					<td style="width:40%;">
					<table style="width: 100%;border-collapse:collapse; font-size: 7;" border="1">
						<thead>
						<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>	
						</thead>
						<tbody id="listbarang3">
							
						</tbody>
					</table>
				</td>
				</tr>
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 4; padding-left: 7px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol><hr>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_kirim_udara3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">SMU</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_smu_udara3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Karantina</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_karantina_udara3"></td>
						</tr>
					
						
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Surcharge</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_charge_udara3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total Biaya</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b id="cetak_total_udara3"></b>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Penerima</td>
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_penerima_udara3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_penerima_udara3"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_penerima_udara3"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 35%;">
							<p style="margin-left: 1%;margin-right: 1%;font-size: 10;">
							Pengirim dengan ini menyatakan bahwa keterangan yang ada pada resi ini benar dan telah memenuhi syarat.
							</p>
							<br>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
							<td style="border-left: 1px solid black; width: 30%;">
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal_udara3"></p>
									<br>
									<p align="center" style="font-size: 9">Tanda Tangan Petugas</p>
							
							</td>
							<td style="border-left: 1px solid black; width: 35%;">
								<p style="font-size: 10;margin-left: 1%;">Penerima telah menerima barang dalam keadaan baik pada <br><br>
									Tanggal&nbsp;&nbsp;:........................................ 
									<br><br>								Jam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:........................................
								</p>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
			</tr>
		</table>
	</div>
	<p style="font-size: 10;">tujuan</p>
	<hr>
	<div>
		<table style="width: 100%;" border="0">
			<tr>
				<td style="width: 25%" align="center">
					<img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
				</td>
				<td style="width: 50%" align="center" >
				<p style="font-size:10;">
					<b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
					Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
					Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)
				</p>
				</td>
				<td style="width: 25%;font-size: 9;">
								<p style="margin-left: 35% " align="right" id="cetak_resi_udara4"></p> 
								<p style="margin-left: 35% " align="right">Pengiriman Via : Udara</p> 
								<p style="margin-right: 7px;" align="right">Tanggal : <?php echo date('d-m-Y');?></p> 
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 100%;border-collapse:collapse;border: 1px solid black;">
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Pengirim</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Deskripsi</td>
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Syarat-syarat</td>
				
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_pengirim_udara4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_pengirim_udara4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_pengirim_udara4"></td>
						</tr>
					</table>
				</td>
				<td rowspan="3" style="border: 1px solid black;">
					<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
					<td>
						<table border="0" style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;">
						<tr>
							<td style="width: 25%;font-size: 10;">Isi Paket</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_isi_paket_udara4"></td>
						</tr>
						
						<tr>
							<td style="width: 25%;font-size: 10;">Jumlah</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;"><span id="cetak_jumlah_barang_udara4"></span></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Total Berat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_berat_udara4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.SMU</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_nosmu_udara4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Metode</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;">
								<b><span id="cetak_metode_udara4"></span></b>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="width: 25%;font-size: 10;">
								<table>
									<tr>
										<td style="font-size: 11;">Kota asal&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_asal_udara4"></span>
											</b>
										</td>
										<td style="font-size: 11;">Tujuan&nbsp;:&nbsp;</td>
										<td style="font-size: 11;">
											<b>
												<span id="cetak_kota_tujuan_udara4"></span>
											</b>
										</td>
									</tr>
								</table>
							</td>
							<td></td>
						</tr>
					</table>
					</td>
						</tr>
				<tr>
					<td style="width:40%;">
					<table style="width: 100%;border-collapse:collapse; font-size: 7;" border="1">
						<thead>
						<tr>
							<td style="border-right: 1px solid black;" align="center">Ukuran Dimensi</td>
							<td align="center">Ukuran Volume</td>
							<td align="center">Berat Aktual</td>
						</tr>
						</thead>
						<tbody  id="listbarang4">
							
						</tbody>
					</table>
				</td>
				</tr>
					</table>
				</td>
				<td rowspan="3" align="center" style="border: 1px solid black;width: 40%;"><ol align="left" style="font-size: 4; padding-left: 7px;padding-top: 5px;">
						<li>Barang-barang yang tidak di asuransikan apabila terjadi kehilangan hanya dapat di ganti maximum Rp. 1.000.000 (Satu juta rupiah).</li>
						<li>Barang yang nilainya diatas 1 juta rupiah harus di asuransikan, jika tidak diasuransikan bukan menjadi tanggung jawab kami.</li>
						<li>Barang-barang yang dikemas dengan tidak sempurna, tidak ditanggung kerusakannya.</li>
						<li>Isi tidak diperiksa, apabila isi kiriman/paket tidak sesuai dengan pengakuan pengirim maka segala resiko bukan menjadi tanggung jawab kami.</li>
						<li>Kami tidak bertanggung jawab/terima klaim atas kebocoran/kerusakan untuk jenis barang berupa kaca/pecah belah,cairan,cream dan elektronik.</li>
						<li>Kami tidak bertanggung jawab atas kerugian dalam bentuk apapun yang di akibatkan oleh keterlambatan pengiriman atau penyampaian barang, serta hilang, tertukar atau tidak kembalinya resi pengiriman barang.</li>
						<li>Bilamana dalam waktu 3 (tiga) hari setelah terima barang tidak ada teguran, bukan menjadi tanggung jawab kami.</li>
						
					</ol><hr>
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Biaya Kirim</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_kirim_udara4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">SMU</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_smu_udara4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Karantina</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_karantina_udara4"></td>
						</tr>
						
						
						<tr>
							<td style="width: 25%;font-size: 10;padding-top: 0;padding-bottom: 0;">Surcharge</td>
							<td style="padding-top: 0;padding-bottom: 0;">&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;padding-top: 0;padding-bottom: 0;" id="cetak_biaya_charge_udara4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;"><b>Total Biaya</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td align="right" style="font-size: 10;">
								<b id="cetak_total_udara4"></b>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> 
				<td style="width:30%;border: 1px solid black; font-size: 10;" align="center">Penerima</td>
			</tr>
			<tr >
				<td align="center" style="border: 1px solid black; width: 20%;">
					<table style="width: 96%;margin-top: 1%;margin-bottom: 1%;  margin-left: 2%;margin-right: 2%;" border="0">
						<tr>
							<td style="width: 25%;font-size: 10;">Nama</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_penerima_udara4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">Alamat</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_alamat_penerima_udara4"></td>
						</tr>
						<tr>
							<td style="width: 25%;font-size: 10;">No.telp</td>
							<td>&nbsp;:&nbsp;</td>
							<td style="font-size: 10;" id="cetak_telp_penerima_udara4"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 35%;">
							<p style="margin-left: 1%;margin-right: 1%;font-size: 10;">
							Pengirim dengan ini menyatakan bahwa keterangan yang ada pada resi ini benar dan telah memenuhi syarat.
							</p>
							<br>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
							<td style="border-left: 1px solid black; width: 30%;">
								<p style="margin-left: 1%; font-size: 10;" id="cetak_tanggal_udara4"></p>
									<br>
									<p align="center" style="font-size: 9">Tanda Tangan Petugas</p>
							
							</td>
							<td style="border-left: 1px solid black; width: 35%;">
								<p style="font-size: 10;margin-left: 1%;">Penerima telah menerima barang dalam keadaan baik pada <br><br>
									Tanggal&nbsp;&nbsp;:........................................ 
									<br><br>								Jam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:........................................
								</p>
							<hr><p style="font-size: 10;" align="center">
								(Tanda tangan/Cap/Nama jelas)
							</p>
							</td>
			</tr>
		</table>
	</div>
	<p style="font-size: 10;">penerima</p>
	</div>
		</div>
@endforeach
</div>
@endsection

@section('js')
<script src="{{asset('assets/js/lib/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/lib/notie/notie.js')}}"></script>
<script src="{{asset('assets/js/lib/notie/notie-init.js')}}"></script>
<script src="{{asset('assets/js/lib/ladda-button/spin.min.js')}}"></script>
<script src="{{asset('assets/js/lib/ladda-button/ladda.min.js')}}"></script>
@endsection
@section('otherjs')
<script src="{{asset('assets/js/editresi.js')}}"></script>
@endsection