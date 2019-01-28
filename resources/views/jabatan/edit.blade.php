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
							<h2>Edit Jabatan</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">

						<form action="{{ url('jabatan/'.$jabat->id) }}" role="form" method="POST">

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Jabatan</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword"  name="jabatan" value="{{$jabat->jabatan}}"></p>
						@if($errors->has('jabatan'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('jabatan')}}
                                         </div>
                                        @endif
						</div>
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