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
							<h2>Bayar Surat Jalan</h2>
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
							<p>Pembuat : {{$row->admin}}</p>
							<div class="invoice-block">
								<h5>Tujuan:</h5>
								<div>{{$row->tujuan}}</div>
								<div>
									{{$row->alamat_tujuan}}
								</div>
							</div>
						</div>
						<div class="col-lg-6 clearfix invoice-info">
							<div class="text-lg-right">
								<h5>{{$row->kode}}</h5>
								<div>Tanggal : {{$row->tgl}}</div>
								
							</div>
							<div class="text-lg-right">
								<div>Status : 
									@if($row->status !='P')
									
									<b>Belum Lunas</b>
									@else
									<b>Lunas</b>
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
										<th>Resi/SMU</th>
										<th>Isi Paket</th>
										<th>Jumlah</th>
										<th>Berat</th>
										<th>Cash</th>
										<th>BT</th>
										<th>Biaya</th>
										<th class="text-center">#</th>
									</tr>
								</thead>
								<tbody>
								@php
									$dataresi = DB::table('resi_pengiriman')
									->where('kode_jalan',$row->kode)
									->get();
								@endphp
								@foreach($dataresi as $resi)
									<tr>
										<td>{{$resi->no_resi}}</td>
										<td>{{$resi->no_smu}}</td>
										<td>{{$resi->nama_barang}}</td>
										<td>{{$resi->jumlah}} Koli</td>
										<td>{{$resi->berat}} Kg</td>
										@if($resi->metode_bayar=='cash')
										<td>Rp. {{number_format($resi->total_biaya,0,',','.')}}</td>
										<td> </td>
										@else
										<td> </td>
										<td>Rp. {{number_format($resi->total_biaya,0,',','.')}}</td>
										
										@endif
										<td>
										Rp. {{number_format($resi->biaya_suratjalan,0,',','.')}}
										</td>
										<td class="text-center">
											@if($resi->biaya_suratjalan>0)
											-
											@else
										<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#Modal{{$resi->id}}">
                     					<i class="fa fa-money"></i>
                     				</button>
                     				@endif
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
							value="{{$resi->no_resi}}" 
							>
						</fieldset>
					</div>
					<div class="col-lg-12">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">No. Resi/SMU</label>
							<input 
							type="text"
							class="form-control" 
							readonly 
							value="{{$resi->no_smu}}" 
							>
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
								<tr>
									<td colspan="3">
										Total
									</td>
									<td>
										{{$row->totalkoli}} Koli
									</td>
									<td>
										{{$row->totalkg}} Kg
									</td>
									<td>
										@if($row->totalcash>0)
										Rp. {{number_format($row->totalcash,0,',','.')}}
										@endif
									</td>
									<td>
										@if($row->totalbt>0)
										Rp. {{number_format($row->totalbt,0,',','.')}}
										@endif
									</td>
									<td>
										@if($row->biaya>0)
										Rp. {{number_format($row->biaya,0,',','.')}}
										@endif
									</td>
									
								</tr>
								</tbody>
							</table>
							<br>
							<a href="{{url('/listsuratjalan')}}" class="btn btn-danger pull-right">Kembali</a>
						</div>

					</div>

			</div>
			@endforeach
	</div>
</div>
        @endsection
