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
							<h2>Ganti Password</h2>
						</div>
                    </div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
                @foreach($datadm as $datadmin)
					<form action="{{ url('editprofile/changepas')}}" role="form" method="POST">
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" class="form-control" name="password_baru" required> 
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                                <input type="password" name="konfirmasi_password_baru" class="form-control" required>
                                    @if (session('errorpass2'))
                            		<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{ session('errorpass2') }}
                            		</div>
                    				@endif
                        </div>
					   {{csrf_field()}}
                        <br>
                        <input type="hidden" name="idnya" value="{{$datadmin->id}}">
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