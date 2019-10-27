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
							<h2>Edit Special Cargo</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">

						<form action="{{ url('kat_akut/'.$kataku->id)}}" role="form" method="POST">
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Kode Kategori</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input type="text" class="form-control" id="exampleInput" placeholder="Masukan Kode Kategori Barang" name="kode" value="{{$kataku->kode}}"><p>
			@if($errors->has('kode'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('kode')}}
                                         </div>
                                        @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama Kategori</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input type="text" class="form-control" id="exampleInput" placeholder="Masukan Nama Kategori Barang" name="nama" value="{{$kataku->nama}}"><p>
			@if($errors->has('nama'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('nama')}}
                                         </div>
                                        @endif
						</div>
					</div>
					<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label semibold">Kelola Akses</label>
						<div class="col-sm-10">
							<select id="exampleSelect" name="aks" class="form-control">								
								@if ($kataku->tempat=="P")
									<option value="{{$kataku->tempat}}">Pusat</option>
								@else
									<option value="{{$kataku->tempat}}">Semua</option>
								@endif
								
								<option value="P">Pusat</option>
								<option value="S">Semua</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
					<label for="exampleSelect" class="col-sm-2 form-control-label semibold">Status</label>
					<div class="col-sm-10">
						<select id="exampleSelect" name="status" class="form-control">
							@if($kataku->status=='pemasukan')
								<option value="{{$kataku->status}}" @if($kataku->status=='pemasukan')selected @endif>Pendatan</option>
							@else
								<option value="{{$kataku->status}}" @if($kataku->status=='pengeluaran')selected @endif>Pengeluaran</option>
							@endif
							@if($kataku->status=='pemasukan')
								<option value="Pengeluaran">Pengeluaran</option>
							@else
								<option value="pendapatan">Pendatan</option>
							@endif
						</select>
					</div>
						@if($errors->has('status'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('status')}}
                                         </div>
                                       @endif
					</div>

{{csrf_field()}}
				<input type="hidden" name="_method" value="PUT">
							<small class="text-muted">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
								
							</small>
				</form>
			</div>
</div>
</div>
        @endsection