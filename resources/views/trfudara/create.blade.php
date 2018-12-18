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
							<h2>Input Tarif Udara</h2>
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
				<form action="{{url('trfudara') }}" role="form" method="POST">
					
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Kode</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" placeholder="Kode Tujuan" name="kode" ></p>
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
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="tujuan" placeholder="Misal : Kalimantan" ></p>
							@if($errors->has('tujuan'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('tujuan')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Airlans</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="airlans" placeholder="Misal : LION PREMIUM(JT 786)"></p>
							@if($errors->has('airlans'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('airlans')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Berat PerKg</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="text" class="form-control" id="inputPassword" name="ber_perkg" required onkeypress="return isNumberKey(event)" placeholder="Misal : 23 kg">
								<div class="input-group-addon">
									Kg
								</div>
							</div>
							@if($errors->has('ber_perkg'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('ber_perkg')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Tarif PerKG</label>
						<div class="col-sm-10">
								<div class="input-group">
								<div class="input-group-addon">
									Rp.
								</div>
								<input type="text" class="form-control" id="inputPassword" name="tarif_perkg" required onkeypress="return isNumberKey(event)" placeholder="Misal : Rp 30000">
								
							</div>
							@if($errors->has('tarif_perkg'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('tarif_perkg')}}
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
								<input type="text" class="form-control" id="inputPassword" name="tarif_dokumen" required onkeypress="return isNumberKey(event)" placeholder="Misal : Rp 30000">
								
							</div>
							@if($errors->has('tarif_dokumen'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('tarif_dokumen')}}
                                         </div>
                                       @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Persentase</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="text" class="form-control" id="inputPassword" name="persentase"  required onkeypress="return isNumberKey(event)" placeholder="Misal : 10 %">
								<div class="input-group-addon">
									%
								</div>
							</div>
							@if($errors->has('persentase'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('persentase')}}
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
