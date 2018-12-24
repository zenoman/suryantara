@extends('layout.masteradmin')


@section('header')
@foreach($webinfo as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection


@section('css')
<link rel="stylesheet" href="{{asset('assets/css/lib/datatables-net/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/datatables-net.min.css')}}">
@endsection


@section('content')
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>List Surat Jalan</h2>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				   
				<div class="card-block">
					 @if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                    @endif
					
					<button class="btn btn-info" data-toggle="modal" data-target="#searchModal">
                     <i class="fa fa-search"></i> Cari Data</button>

                                <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Cari Data Spesifik Dari Semua Data</h4>
                                        </div>
                                        

                                        <div class="modal-body">
                                           <form method="post" action="{{url('admin/cari')}}">
                                            <div class="form-group">
                                                <input type="text" name="cari" class="form-control" placeholder="cari berdasarkan nama admin" required>
                                            </div>
                                           {{csrf_field()}}
                                            <input type="submit" class="btn btn-info" value="Cari Data">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            
                                            </form>
                                        </div>
                                 
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                    <br><br>
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Tujuan</th>
							<th>Tanggal</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>kode</th>
							<th>Tujuan</th>
							<th>Tanggal</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->kode}}</td>
                            <td>{{$row->tujuan}}</td>
                            <td>{{$row->tgl}}</td>
                            <td>@if($row->status=='Y')
                            	
								<span class="label label-danger">
								Belum Lunas
								</span>
                            	@else
                            	<span class="label label-success">
								Lunas
								</span>
                            	@endif
                            	</td>
                            <td>
                    			<button class="btn btn-primary"
						data-toggle="modal"
						data-target=".bd-example-modal-lg{{$row->id}}"><i class="glyphicon glyphicon-usd"></i> Telah Di Bayar</button>

						<div class="modal fade bd-example-modal-lg{{$row->id}}"
					 tabindex="-1"
					 role="dialog"
					 aria-labelledby="myLargeModalLabel"
					 aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
									<i class="font-icon-close-2"></i>
								</button>
								<h4 class="modal-title" id="myModalLabel">Detail Surat Jalan</h4>
							</div>
							<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 company-info">
							<p>Pembuat : {{$row->username}}</p>

							<!-- <div class="invoice-block">
								<div>1 Infinite loop</div>
								<div>95014 Cuperino, CA</div>
								<div>United States</div>
							</div>

							<div class="invoice-block">
								<div>Telephone: 555-692-7754</div>
								<div>Fax: 555-692-7754</div>
							</div> -->

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
										<td>Rp. {{number_format($resi->total_biaya,2,',','.')}}</td>
										<td> </td>
										@else
										<td> </td>
										<td>Rp. {{number_format($resi->total_biaya,2,',','.')}}</td>
										@endif
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
										Rp. {{number_format($row->totalcash,2,',','.')}}
										@endif
									</td>
									<td>
										@if($row->totalbt>0)
										Rp. {{number_format($row->totalbt,2,',','.')}}
										@endif
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12 terms-and-conditions">
							<strong>Status : </strong>
							@if($row->status=='Y')
							Surat Jalan Belum Di lunasi
							@else
							Surat Jalan Telah Lunas
							@endif
							<h4>Perkiraan Biaya : Rp. {{number_format($row->biaya,2,',','.')}}</h4>
							@if($row->status != 'P')
							<form action="bayarsj" method="post">
								<label for="biaya_baru">Perubahan Biaya</label>
								<input type="text" name="biaya_baru" class="form-control" placeholder="Opsional, Tergantung Apakah Ada Perubahan Biaya">
								<input type="hidden" name="id_sj" value="{{$row->id}}">
								{{@csrf_field()}}
							@endif
						</div>
						
					</div>
							</div>
							<div class="modal-footer">
								@if($row->status != 'P')
								<button type="submit" class="btn btn-rounded btn-primary" onclick="return confirm('Apakah Surat Jalan Ini Telah Di Lunasi ?')">Bayar</button>
								</form>
								@endif
								<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div><!--.modal-->
                            </td>
						</tr>
						@endforeach
						</tbody>
					</table>
					 {{ $data->links() }}
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	@endsection

		@section('js')
	<script src="{{asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>
	<script>
		$(function() {
			$('#example').DataTable({
            responsive: true,
            "paging":false
        });
		});
	</script>
	@endsection