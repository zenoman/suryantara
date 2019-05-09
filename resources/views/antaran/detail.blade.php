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
							<h2>Ubah Status Resi</h2>
						</div>
					</div>
				</div>
			</header>
			@foreach($data as $row)
			<div class="box-typical box-typical-padding">
				@if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                    @endif
				<div class="row">
						<div class="col-lg-6 company-info">
							<p>Pemegang : {{$row->pemegang}}</p>
							<div class="invoice-block">
								<div>Telp. Karyawan : {{$row->telp}}</div>
								
							</div>
						</div>
						<div class="col-lg-6 clearfix invoice-info">
							<div class="text-lg-right">
								<h5>{{$row->kode}}</h5>
								<div>Tanggal : {{$row->tgl}}</div>
								
							</div>
							<div class="text-lg-right">
								<div>Status : 
									@if($row->status !='S')
									
									<b>Belum Sukses</b>
									@else
									<b>Sukses</b>
									@endif
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="row table-details">
						<div class="col-lg-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Resi</th>
										<th>Pengirim</th>
										<th>Isi Paket</th>
										<th>Alamat Penerima</th>
										<th>Jumlah</th>
										<th>Berat</th>
										<th class="text-center">#</th>
									</tr>
								</thead>
								<tbody>
								@php
									$dataresi = DB::table('resi_pengiriman')
									->where('kode_antar',$row->kode)
									->get();
								@endphp
								@foreach($dataresi as $resi)
									<tr>
										<td>
											@if($resi->batal=='N')
											{{$resi->no_resi}}
											@else
											<span class="text-danger">
												{{$resi->no_resi}}
											</span>
											@endif
										</td>
										<td>{{$resi->nama_pengirim}}</td>
										<td>{{$resi->nama_barang}}</td>
										<td>{{$resi->alamat_penerima}}</td>
										<td>{{$resi->jumlah}} Koli</td>
										<td>{{$resi->berat}} Kg</td>
										<td class="text-center">
												<a href="{{url('/suksesantar/'.$resi->id)}}" class="btn btn-success btn-sm" onclick="return confirm('Apakah Resi Sudah Sampai Di Tujuan ?')">
													<i class="fa fa-check"></i>
												</a>
												<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal{{$resi->id}}">
                     							<i class="fa fa-close"></i>
                     							</button>
                     					</td>
									</tr>
							<div class="modal fade" id="Modal{{$resi->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Bayar Resi </h4>
                                        </div>
                                        <div class="modal-body">
                                           <form method="post" action="{{url('/bayarsj')}}">
                                           	<div class="row">
                                           		<div class="col-lg-12">
													<fieldset class="form-group">
														<label class="form-label semibold" for="exampleInput">No. Resi</label>
														<input 
														type="text"
														class="form-control" 
														readonly 
														value="{{$resi->no_resi}}">
													</fieldset>
												</div>
												<div class="col-lg-12">
													<fieldset class="form-group">
														<label class="form-label semibold" for="exampleInput">No. Resi/SMU</label>
														<input 
														type="text"
														class="form-control" 
														readonly 
														value="{{$resi->no_smu}}">
													</fieldset>
												</div>
                                           		<div class="col-lg-12">
													<fieldset class="form-group">
														<label class="form-label semibold" for="exampleInput">Jumlah</label>
														<input 
														type="text" 
														class="form-control" 
														name="jumlah" 
														onkeypress="return isNumberKey(event)" required>
														<input type="hidden" name="nomer" value="{{$resi->id}}">
														<input type="hidden" name="kode" value="{{$row->kode}}">
													</fieldset>
												</div>
											</div>
                                            {{csrf_field()}}
                                            <input type="submit" class="btn btn-info" value="Simpan">
											<button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                            </form>
                                        </div>
                                 	</div>
                                </div>
                            </div> 
								@endforeach
								
								</tbody>
							</table>
							<br>
							<a href="{{url('/listantaran')}}" class="btn btn-danger pull-right">Kembali</a>
						</div>

					</div>

			</div>
			@endforeach
	</div>
</div>
        @endsection
