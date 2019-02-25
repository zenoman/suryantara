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
								<div>Tanggal: {{$row->tgl}}</div>
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
										<button class="btn btn-primary btn-sm">
											<i class="fa fa-money"></i>
										</button>
									</td>
									</tr>
								@endforeach
								<tr>
									<td colspan="2">
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
						</div>
					</div>
			</div>
			@endforeach
	</div>
</div>
        @endsection
