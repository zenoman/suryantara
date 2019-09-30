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
							<h2>Input Cabang</h2>
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
                    @foreach($data as $row)
				<form action="{{ url('cabang/'.$row->id) }}" role="form" method="POST">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input type="text" value="{{$row->nama}}" class="form-control" name="nama" required>
								<p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Kode Resi</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input type="text" class="form-control" name="koderesi" value="{{$row->koderesi}}" required>
								<p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Alamat</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input type="text" value="{{$row->alamat}}" class="form-control" name="alamat" required>
								<input type="hidden" name="_method" value="put">
								<p>	
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Kota</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input type="text" class="form-control" value="{{$row->kota}}" name="kota" required>
								<p>	
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Kop Surat</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<textarea name="kop" id="kop" class="form-control">{{$row->kop}}</textarea>
								<p>	
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">No.Rek</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<textarea name="norek" id="norek" class="form-control">{{$row->norek}}</textarea>
								<p>	
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Ket. Transfer</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<textarea name="ket_transfer" id="norek" class="form-control">{{$row->ket_transfer}}</textarea>
								<p>	
						</div>
					</div>
					{{csrf_field()}}
							<small class="text-muted text-right">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
							</small>
				</form>
				@endforeach
			</div>


			</div>
			</div>
			

    @endsection
    @section('js')
        <script src="{{asset('assets/js/ckeditor.js')}}"></script>
    @endsection
    @section('otherjs')
    @endsection
