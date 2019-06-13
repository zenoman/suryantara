@extends('layout.masteradminnew')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection

@section('content')
<script>
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      };
      
     
</script>
<div class="page-content">
		<div class="container-fluid">
		<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Tambah Data Pajak Perusahaan</h2>
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
				<form action="{{url('/pajak') }}" role="form" method="POST" enctype="multipart/form-data">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Pembuat
						</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="text" name="admin" value="{{Session::get('username')}}" class="form-control" readonly>
								
							</div>
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Jumlah
						</label>
						<div class="col-sm-10">
							<div class="input-group">
								<div class="input-group-addon">
									Rp. 
								</div>
								<input type="text" class="form-control" name="jumlah" required onkeypress="return isNumberKey(event)" placeholder="Misal : 150000">
								
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Keterangan
						</label>
						<div class="col-sm-10">
							<div class="input-group">
								<textarea rows="4" class="form-control" placeholder="Masukan Keterangan.." name="keterangan" required></textarea>
								
							</div>
									@if($errors->has('keterangan'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('keterangan')}}
                                         </div>
                                    @endif
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Tanggal
						</label>
						<div class="col-sm-10">
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
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Foto
						</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="file" name="gambar" required accept="image/*" id="photo">
								
							</div>
						</div>
					</div>
						{{csrf_field()}}
							<small class="text-muted text-right">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">

								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
							</small>
				</form>
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

