@extends('layout.masteradminnew')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection

@section('content')
<script type="text/javascript">
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</script>
<div class="page-content">
		<div class="container-fluid">
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Input Pajak</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				@foreach($armada as $row)
				<form action="{{ url('pajakarmada') }}" role="form" method="POST" enctype="multipart/form-data">
					<div class="form-group row">
						<div class="col-sm-4">
							<label class="form-control-label semibold">Pembuat</label>
							<div class="input-group">
								<input 
								type="text" 
								class="form-control" 
								value="{{Session::get('username')}}"
								readonly 
								>
							</div>
						</div>
						<div class="col-sm-4">
							<label class="form-control-label semibold">Nama Kendaraan</label>
							<div class="input-group">
								<input 
								type="text" 
								class="form-control" 
								value="{{$row->nama}}"
								readonly 
								>
							</div>
						</div>
						<div class="col-sm-4">
							<label class="form-control-label semibold">No. Polisi</label>
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								value="{{$row->nopol}}"
								readonly>
							</div>
						</div>
					</div>
					<div class="form-group row">
						
						<div class="col-sm-4">
							<label class="form-control-label semibold">No. Rangka</label>
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								value="{{$row->nomor_rangka}}"
								readonly>
							</div>
						</div>
						<div class="col-sm-4">
							<label class="form-control-label semibold">No. Mesin</label>
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								value="{{$row->nomor_mesin}}"
								readonly>
							</div>
						</div>
						<div class="col-sm-4">
							<label class="form-control-label semibold">Warna</label>
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								value="{{$row->warna}}" 
								readonly>
							</div>
						</div>
					</div>
					
					{{csrf_field()}}
					<hr>
					<div class="form-group row">
						<div class="col-sm-4">
							<label class="form-control-label semibold">Pilih Pajak</label>
							<div class="input-group">
								<select name="pajak" class="form-control">
									@foreach($datapajak as $dp)
										<option value="{{$dp->id}}">{{$dp->nama_pajak}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<label class="form-control-label semibold">Tanggal Bayar</label>
							<div class="input-group">
								<input
								type="date"
								class="form-control"
								value="{{date('Y-m-d')}}"
								name="tglbayar"
								required
								>
							</div>
						</div>
						<div class="col-sm-4">
							<label class="form-control-label semibold">Tanggal Kadaluarsa</label>
							<div class="input-group">
								<input
								type="date"
								class="form-control"
								name="tglkadaluarsa"
								required
								>
							</div>
						</div>
						
					</div>
					<div class="form-group row">
						<div class="col-sm-6">
							<label class="form-control-label semibold">Total Biaya</label>
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								name="total"
								onkeypress="return isNumberKey(event)"
								required
								>
							</div>
						</div>
						<div class="col-sm-6">
							<label class="form-control-label semibold">Gambar Nota / Bukti Pembayaran</label>
							<div class="input-group">
								<input
								type="file"
								name="gambar"
								class="form-control"
								accept="image/*"
								id="photo"
								required
								>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
							<label class="form-control-label semibold">Keterangan</label>
							<div class="input-group">
								<textarea class="form-control" rows="5" name="keterangan">
									
								</textarea>
							</div>
						</div>
						<input type="hidden" value="{{$row->id}}" name="kodeunit">
					</div>
					<div class="text-right">
						<input class="btn btn-primary" type="submit" name="submit" value="simpan">
						<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
					</div>

				</form>
				@endforeach
			</div>
			</div>
			</div>
        @endsection
 @section('otherjs')
        <script>
            $('input[type="file"]').change(function(){
    var imageSizeArr = 0;
    var imageSize = document.getElementById('photo');
    var imageCount = imageSize.files.length;
    for (var i = 0; i < imageSize.files.length; i++)
    {
         var imageSiz = imageSize.files[i].size;
         var imagename = imageSize.files[i].name;
         if (imageSiz > 3000000) {
             $('#test').text('3');
             var imageSizeArr = 1;
         }
         if (imageSizeArr == 1)
         {
             alert('Maaf, gambar "'+imagename+'" terlalu besar / memiliki ukuran lebih dari 3MB');
             $('#photo').val('');
         }
     }
 }); 
        </script>
        @endsection