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

					@foreach($setting as $row)
				<form action="{{url('setting/'.$row->id) }}" role="form" method="POST" enctype="multipart/form-data">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Header</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Header Website" name="namaweb" value="{{$row->namaweb}}"></p>
						@if($errors->has('namaweb'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('namaweb')}}
                                         </div>
                                        @endif
						</div>
					</div>
          <div class="form-group row">
            <label class="col-sm-2 form-control-label semibold">Nama Web</label>
            <div class="col-sm-10">
              <p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Nama Website" name="header" value="{{$row->header}}"></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 form-control-label semibold">Deskripsi</label>
            <div class="col-sm-10">
              <p class="form-control-static"><textarea rows="4" class="form-control" placeholder="Deskripsi website" name="deskripsi">{{$row->desk}}</textarea></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 form-control-label semibold">Email</label>
            <div class="col-sm-10">
              <p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="email" placeholder="Email" value="{{$row->email}}"></p>
            @if($errors->has('email'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('email')}}
                                         </div>
                                        @endif
            </div>
          </div>   
           
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Kontak</label>
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
            <label class="col-sm-2 form-control-label semibold">Alamat</label>
            <div class="col-sm-10">
              <p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="alamat" placeholder="Text Readonly" value="{{$row->alamat}}"></p>
            @if($errors->has('alamat'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('alamat')}}
                                         </div>
                                        @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 form-control-label semibold">Info Udara</label>
            <div class="col-sm-10">
              <p class="form-control-static"><textarea rows="4" class="form-control ckeditor" placeholder="Deskripsi website" name="desk_udara" id="desk_udara">{{$row->desk_udara}}</textarea></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 form-control-label semibold">Info Darat</label>
            <div class="col-sm-10">
              <p class="form-control-static"><textarea rows="4" class="form-control ckeditor" placeholder="Deskripsi website" name="desk_darat" id="desk_darat">{{$row->desk_darat}}</textarea></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 form-control-label semibold">Info Laut</label>
            <div class="col-sm-10">
              <p class="form-control-static"><textarea rows="4" class="form-control ckeditor" placeholder="Deskripsi website" name="desk_laut" id="desk_laut">{{$row->desk_laut}}</textarea></p>
            </div>
          </div>
					 					<div class="form-group row">
                              <label  class="col-sm-2 form-control-label semibold">Ganti Icon</label>
                              <div class="col-sm-10">
                                 @if(isset($row->icon) && $row->icon)
                                            <img src="{{asset('img/setting/'.$row->icon)}}" width="50" height="50">
                                            @else
                                            <img src="{{asset('img/gmbr.png')}}" width="100" height="100">
                                            @endif
                                            <br><br>
                                <p class="form-control-static">
                                           
                                            <input type="file" name="icon" accept="image/*">
                                          </p>
                                        </div>
                                      </div> 
                                       <!--====================-->
                                        <div class="form-group row">
                                          <label  class="col-sm-2 form-control-label semibold">Ganti Logo</label>
                                          <div class="col-sm-10">
                                            @if(isset($row->logo) && $row->logo)
                                            <img src="{{url('img/setting/'.$row->logo)}}" width="100" height="100">
                                            @else
                                            <img src="{{asset('img/gmbr.png')}}" width="100" height="100">
                                            @endif
                                            <br><br>
                                            <p class="form-control-static">
                                            <input type="file" name="logo" accept="image/*">
                                          </p>
                                        </div>
                                      </div>
                                        
                                       
				@endforeach
{{csrf_field()}}
				<input type="hidden" name="_method" value="PUT">
							<small class="text-muted"><input class="btn btn-primary" type="submit" name="submit" value="simpan"></small>
				</form>
			</div>
	</div></div>
        @endsection
        @section('js')
        <script src="{{asset('assets/js/ckeditor.js')}}"></script>
        @endsection
        @section('otherjs')
         <script>
    ClassicEditor
    .create( document.querySelector('#desk_udara'),{
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    }
    )

    .catch( error => {
        console.log( error );
    });

    </script>
    <script>
    ClassicEditor
    .create( document.querySelector('#desk_darat'),{
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    }
    )

    .catch( error => {
        console.log( error );
    });

    </script>
    <script>
    ClassicEditor
    .create( document.querySelector('#desk_laut'),{
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    }
    )

    .catch( error => {
        console.log( error );
    });

    </script>
        @endsection
