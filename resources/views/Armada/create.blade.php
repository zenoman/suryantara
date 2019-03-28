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
							<h2>Input Data Armada</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<form action="{{ url('armada') }}" role="form" method="POST">
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama Kendaraan</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input 
								type="text" 
								class="form-control" 
								placeholder="Contoh : Daihatsu Gran Max" name="nama"
								required 
								>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">No. Polisi</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								name="nopol" 
								required>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">No. Rangka</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								name="norangka" 
								required>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">No. Mesin</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								name="nomesin" 
								required>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Warna</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								name="warna" 
								required 
								placeholder="Contoh : Merah">
							</div>
						</div>
					</div>
					{{csrf_field()}}
					<div class="text-right">
						<input class="btn btn-primary" type="submit" name="submit" value="simpan">
						<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
					</div>
				</form>
			</div>
			</div>
			</div>
        @endsection
