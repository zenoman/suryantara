@extends('layout.masteradminnew')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection

@section('content')
<div class="page-content">
		<div class="container-fluid">
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Input Data Penyusutan</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<form action="{{ url('nyusut') }}" role="form" method="POST">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input 
								type="text" 
								class="form-control"
								name="nama" 
								placeholder="Masukan Nama Barang"
								 >
							</p>
							@if($errors->has('nama'))
                            	<div class="alert alert-danger">
                            		{{ $errors->first('nama')}}
                            	</div>
                           @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Harga Perolehan</label>
						<div class="col-sm-10">
								<div class="input-group">
								<div class="input-group-addon">
									Rp.
								</div>
								<input type="text" class="form-control" id="inputPassword" name="harga"   onkeypress="return isNumberKey(event)" placeholder="Misal : Rp 30000">
								
							</div>
							@if($errors->has('harga'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('harga')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nilai Residu</label>
						<div class="col-sm-10">
								<div class="input-group">
								<div class="input-group-addon">
									Rp.
								</div>
								<input type="text" class="form-control" id="inputPassword" name="harga"   onkeypress="return isNumberKey(event)" placeholder="Misal : Rp 30000">
								
							</div>
							@if($errors->has('harga'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('harga')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Umur Ekonomis Perbulan</label>
						<div class="col-sm-10">
								<div class="input-group">
								<input type="text" class="form-control" id="inputPassword" name="umurbln"   onkeypress="return isNumberKey(event)" placeholder="Misal : 5 bln">
								<div class="input-group-addon">
									/Bln
								</div>
								
							</div>
							@if($errors->has('umurbln'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('umurbln')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Umur Ekonomis Tahun</label>
						<div class="col-sm-10">
								<div class="input-group">
								<input type="text" class="form-control" id="inputPassword" name="umurthn"   onkeypress="return isNumberKey(event)" placeholder="Misal : 5 bln">
								<div class="input-group-addon">
									/Thn
								</div>
								
							</div>
							@if($errors->has('umurthn'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('umurthn')}}
                                         </div>
                                       @endif
						</div>
					</div>


{{csrf_field()}}
							<small class="text-muted">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
							</small>
				</form>
			</div>
			</div>
			</div>
        @endsection