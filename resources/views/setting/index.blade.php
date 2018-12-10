@extends('layout.masteradmin')

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
							<h2>Data Setting</h2>
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
				<h5 class="m-t-lg with-border">Horizontal Inputs</h5>

					@foreach($setting as $row)
				<form action="{{url('setting/'.$row->id) }}" role="form" method="POST" enctype="multipart/form-data">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Nama Web</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="namaweb" value="{{$row->namaweb}}"></p>
						@if($errors->has('namaweb'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('namaweb')}}
                                         </div>
                                        @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Email</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="email" placeholder="Text Disabled" value="{{$row->email}}"></p>
						@if($errors->has('email'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('email')}}
                                         </div>
                                        @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Kontak</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="kontak" placeholder="Text Readonly" value="{{$row->kontak}}"></p>
						@if($errors->has('kontak'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('kontak')}}
                                         </div>
                                        @endif
						</div>
					</div>
					 					<div class="form-group row">
                                            <label  class="col-sm-2 form-control-label">Ganti Icon</label><p>
                                            @if(isset($row->icon) && $row->icon)
                                            <img src="../img/setting/{{$row->icon}}" width="50" height="50">
                                            @else
                                            <img src="{{asset('img/gmbr.png')}}" width="100" height="100">
                                            @endif
                                            <input type="file" name="icon">
                                        </div>
                                        @if($errors->has('ico'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('ico')}}
                                         </div>
                                       @endif
                                            <div class="form-group row">
                                            <label  class="col-sm-2 form-control-label">Ganti Logo</label><p>
                                            @if(isset($row->logo) && $row->logo)
                                            <img src="../img/setting/{{$row->logo}}" width="100" height="100">
                                            @else
                                            <img src="{{asset('img/gmbr.png')}}" width="100" height="100">
                                            @endif
                                            <input type="file" name="logo">
                                        </div>
                                          @if($errors->has('logo'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('logo')}}
                                         </div>
                                       @endif
				@endforeach
{{csrf_field()}}
				<input type="hidden" name="_method" value="PUT">
							<small class="text-muted"><input class="btn btn-primary" type="submit" name="submit" value="simpan"></small>
				</form>
			</div>
	</div></div>
        @endsection
