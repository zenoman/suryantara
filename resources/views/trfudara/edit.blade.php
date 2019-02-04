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
							<h2>Edit tarif Udara</h2>
						</div>
					</div>
				</div>
			</header>
 @foreach($trfudara as $row)

			<div class="box-typical box-typical-padding">
						<form action="{{ url('trfudara/'.$row->id) }}" role="form" method="POST">

			<input type="hidden" class="form-control" id="inputPassword" placeholder="Text" name="id" value="{{$row->id}}">
				<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold	">Kode</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="kode" value="{{$row->kode}}"></p>
						@if($errors->has('kode'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('kode')}}
                                         </div>
                                        @endif
						</div>
					</div>
				<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Tujuan</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="tujuan" value="{{$row->tujuan}}"></p>
						@if($errors->has('tujuan'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('tujuan')}}
                                         </div>
                                        @endif
						</div>
					</div>
				<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Airlines</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Text" name="airlans" value="{{$row->airlans}}"></p>
						@if($errors->has('airlans'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('airlans')}}
                                         </div>
                                        @endif
						</div>
					</div>					
					
						<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Tarif PerKg</label>
						<div class="col-sm-10">
							<div class="input-group">
							<div class="input-group-addon">
									Rp.
								</div>
							<input type="text" class="form-control" id="inputPassword"  name="biaya_perkg" onkeypress="return isNumberKey(event)" value="{{$row->perkg}}">
							
							</div>
							@if($errors->has('biaya_perkg'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('biaya_perkg')}}
                                         </div>
                                       @endif
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Minimal Heavy</label>
						<div class="col-sm-10">
							<div class="input-group">
							<input type="text" class="form-control" id="inputPassword" required onkeypress="return isNumberKey(event)" placeholder="Text" name="minimal_heavy" value="{{$row->minimal_heavy}}">

								<div class="input-group-addon">
									Kg
								</div>
							</div>
						@if($errors->has('minimal_heavy'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('minimal_heavy')}}
                                         </div>
                                        @endif
						</div>
					</div>
										
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Tarif Dokumen</label>
						<div class="col-sm-10">
							<div class="input-group">
							<div class="input-group-addon">
									Rp.
								</div>
							<input type="text" class="form-control" id="inputPassword"  name="biaya_dokumen" onkeypress="return isNumberKey(event)" value="{{$row->biaya_dokumen}}">
							
							</div>
							@if($errors->has('biaya_dokumen'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('biaya_dokumen')}}
                                         </div>
                                       @endif
						</div>
					</div>
					@endforeach
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