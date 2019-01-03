@extends('layout.masteradmin')

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
							<h2>Tambah Data Pengeluaran Lain</h2>
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
				<form action="{{url('/pengeluaranlain') }}" role="form" method="POST" enctype="multipart/form-data">
					
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
						<label class="col-sm-2 form-control-label semibold">Kategori Pengeluaran</label>
						<div class="col-sm-10">
							<p class="form-control-static">
							<select class="form-control" name="kategori">
								<option value="bbm">bbm</option>
								<option value="servis">servis</option>
								<option value="parkir">parkir</option>
								<option value="tol">tol</option>
								<option value="lainya">lainya</option>
							</select>
							</p>
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
									@if($errors->has('berat_minimal'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('berat_minimal')}}
                                         </div>
                                    @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Foto
						</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="file" name="gambar" required accept="image/*">
								
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

