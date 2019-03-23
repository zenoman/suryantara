@extends('layout.masteradminnew')

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
								<input type="text" class="form-control" value="{{$row->no_resi}}" readonly>
							</div>
						</div>
					</div>
				<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Pemegang</label>
							<div class="input-group">
								<input type="text" class="form-control" value="{{$row->nama}}" readonly>
								
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
								<input type="text" class="form-control" id="nama_barang_darat" @if($row->pengiriman_via=='darat')value="{{$row->alamat_penerima}}"
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
								<button class="btn btn-primary ladda-button" data-style="zoom-out" id="btnsimpan_darat" type="button"><span class="ladda-label">Simpan & Selesai</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
								</button>

								<a onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</a>
								
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

								<a onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</a>
								
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
								<input type="text" class="form-control" id="volume_udara1" onkeypress="return isNumberKey2(event)" onchange="hitungberat()"  @if($row->pengiriman_via=='udara')
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
								<input type="text" class="form-control" id="berat_udara1" onkeypress="return isNumberKey2(event)" onchange="hitungberat()" @if($row->pengiriman_via=='udara')
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
					<!-- <div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="form-label" for="exampleInputDisabled">Status</label>
							<div class="input-group">
								<input type="text" class="form-control" id="status_udara" readonly>
								
							</div>
						</div>
					</div> -->
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
								<button class="btn btn-primary ladda-button" data-style="zoom-out" id="btnsimpan_udara"><span class="ladda-label">Simpan & Selesai</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
								</button>

								<a onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</a>
								
							</small>
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
<script src="{{asset('assets/js/editresimanual.js')}}"></script>
@endsection