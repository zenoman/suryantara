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
							<h2>Ganti Password </h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
						<form action="{{ url('admin/'.$datadmin->id) }}/changepas" role="form" method="POST">

				

					<div class="form-group">
						<label>Konfirmasi username</label>
						
							<input type="hidden" class="form-control"  name="username" value="{{$datadmin->id}}/changepas">
							<input type="text" class="form-control" name="konfirmasi_username">
                                            
                           	<p class="help-block">*Masukan Username user yang akan di ganti passwordnya</p>
									@if($errors->has('konfirmasi_username'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('konfirmasi_username')}}
                                         </div>
                                    @endif
						
						</div>
							<div class="form-group">
                                            <label>Konfirmasi Password</label>
                                            <input type="hidden" name="password" value="{{$datadmin->password}}">

                                            <input type="password" class="form-control" name="konfirmasi_password">

                                            <p class="help-block">*Masukan password lama user yang akan diganti passwordnya</p>
                                            @if (session('errorpass1'))
                    			<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('errorpass1') }}
                    		</div>
                    		@endif
                                        </div>
                                        @if($errors->has('konfirmasi_password'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('konfirmasi_password')}}
                                         </div>
                                        @endif
                                        
                                <div class="form-group">
                                            <label>Password Baru</label>
                                            <input type="password" class="form-control" name="password_baru">
                                        </div>
                                       @if($errors->has('password_baru'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('password_baru')}}
                                </div>
                                        @endif

                                        <div class="form-group">
                                            <label>Konfirmasi Password Baru</label>
                                            <input type="password" name="konfirmasi_password_baru" class="form-control">
                                            @if($errors->has('konfirmasi_password_baru'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('konfirmasi_password_baru')}}
                                        </div>
                                            @endif
                                            @if (session('errorpass2'))
                    		<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('errorpass2') }}
                    		</div>
                    						@endif
					
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