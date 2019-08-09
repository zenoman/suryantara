@extends('layout.masteradminnew')
@section('header')
@foreach($webinfo as $info)
<title>{{$info->namaweb}}</title>
<link href="{{asset('img/setting/'.$info->icon)}}" rel="icon" type="image/png">
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
							<h2>List Pengiriman</h2>
							<h5>Hasil Pencarian "{{$cari}}"</h5>
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
                     
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>No.Resi</th>
							<th>Tanggal</th>
							<th>Jalur</th>
							<th>Isi Paket</th>
							<th>Tujuan</th>
							<th>Pengirim</th>
							<th>Admin</th>
							<th>Status</th>
							<td>Aksi</td>
						</tr>
						</thead>
						
						<tbody>
						<?php $i = 1;?>
                            @foreach($datakirim as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td class="text-center">
                            	@if($row->tgl_lunas !=null)
									@if($row->status=='Y')
                            			<button class="btn btn-sm btn-success"
										data-toggle="modal"
										data-target=".bd-example-modal-lg{{$row->id}}">{{$row->no_resi}}</button>
                            		@elseif($row->no_smu == null)
                            			<button class="btn btn-sm btn-primary"
										data-toggle="modal"
										data-target=".bd-example-modal-lg{{$row->id}}">{{$row->no_resi}}</button>
                            		@else
                            			<button class="btn btn-sm btn-primary"
										data-toggle="modal"
										data-target=".bd-example-modal-lg{{$row->id}}">{{$row->no_resi}}</button>
									@endif

								@else

									@if($row->status=='Y')
										<button class="btn btn-sm btn-success"
										data-toggle="modal"
										data-target=".bd-example-modal-lg{{$row->id}}"><i class="fa fa-exclamation-triangle"></i> {{$row->no_resi}}</button>
                            		@elseif($row->no_smu == null)
                            		<button class="btn btn-sm btn-primary"
										data-toggle="modal"
										data-target=".bd-example-modal-lg{{$row->id}}"><i class="fa fa-exclamation-triangle"></i> {{$row->no_resi}}</button>
                            		@else
                            			<button class="btn btn-sm btn-primary"
										data-toggle="modal"
										data-target=".bd-example-modal-lg{{$row->id}}"><i class="fa fa-exclamation-triangle"></i> {{$row->no_resi}}</button>
									@endif
								@endif

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
								<h4 class="modal-title" id="myModalLabel">Detail Resi</h4>
							</div>
							<div class="modal-body">
				
				<div class="card-block invoice">
					<div class="row">
						<div class="col-lg-6 company-info text-left">
							
							@if($row->pengiriman_via=='udara')
							<h5 style="margin-bottom: 0.2rem;">Isi paket : {{$row->nama_barang}}</h5>
							<p>No. SMU : {{$row->no_smu}}</p>
							@else
							<h5>Isi paket : {{$row->nama_barang}}</h5>
							@endif

							<p>Pengiriman Via : {{$row->pengiriman_via}}</p>

							<div class="invoice-block">
								<div>Pengirim : {{$row->nama_pengirim}}</div>
								<div>No.Telpon : {{$row->telp_pengirim}}</div>
								<div>Alamat : {{$row->alamat_pengirim}}</div>
							</div>
							<br>
							<div class="invoice-block">
								<div>Penerima : {{$row->nama_penerima}}</div>
								<div>No.Telpon : {{$row->telp_penerima}}</div>
								<div>Alamat : {{$row->alamat_penerima}}</div>
							</div>
							<br>
							<div class="invoice-block">
							<div>Tanggal : {{$row->tgl}}</div>
								<div>Tujuan : {{$row->kota_asal}} - {{$row->kode_tujuan}}</div>
								<div>Metode Bayar : {{$row->metode_bayar}}</div>
							</div>
							<br>
							<!-- <div class="invoice-block">
								<h5>Invoice To:</h5>
								<div>Rebeca Manes</div>
								<div>
									Normand axis LTD <br>
									3 Goodman street
								</div>
							</div> -->
						</div>
						<div class="col-lg-6 clearfix invoice-info">
							<div class="text-lg-right">
								<h5>{{$row->no_resi}}</h5>
								
								<table class="pull-right table-sm">
									<tr>
										<td>Operator</td>
										<td>{{$row->admin}}</td>
									</tr>
									<tr>
										<td>Berat Aktual</td>
										<td>{{$row->berat}} Kg</td>
									</tr>
									<tr>
										<td>Berat Volumetrik</td>
										<td>{{$row->ukuran_volume}} Kg</td>
									</tr>
									<tr>
										<td>Dimensi</td>
										<td>{{$row->dimensi}}</td>
									</tr>
									<tr>
										<td>Jumlah</td>
										<td>{{$row->jumlah}} Koli</td>
									</tr>
								</table>
								<br>
								
							</div>
							
						</div>
					</div>
					<div class="row table-details">
						<div class="col-lg-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th colspan="2" class="text-center">Detail Biaya</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										
										<td class="text-right">Biaya Kirim</td>
										<td class="text-right">Rp. {{number_format($row->biaya_kirim,0,',','.')}}</td>
										
									</tr>
								@if($row->pengiriman_via=='udara')
									<tr>
										<td class="text-right">Biaya SMU</td>
										<td class="text-right">Rp. {{number_format($row->biaya_smu,0,',','.')}}</td>
									</tr>
									<tr>
										<td class="text-right">Biaya Karantina</td>
										<td class="text-right">Rp. {{number_format($row->biaya_karantina,0,',','.')}}</td>
									</tr>
								@else
									<tr>
										<td class="text-right">Biaya Packing</td>
										<td class="text-right">Rp. {{number_format($row->biaya_packing,0,',','.')}}</td>
									</tr>
									<tr>
										<td class="text-right">Biaya Asuransi</td>
										<td class="text-right">Rp. {{number_format($row->biaya_asuransi,0,',','.')}}</td>
									</tr>
								@endif
									
									<tr>
										
										<td class="text-right">PPN</td>
										<td class="text-right">Rp. {{number_format($row->biaya_ppn,0,',','.')}}</td>
										
									</tr>
									<tr>
										<td><h4>Total</h4></td>
										<td class="text-right"><h4>
											Rp. {{number_format($row->total_biaya,0,',','.')}}
										</h4></td>
									</tr>
									
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<br>
						<div class="col-lg-12 terms-and-conditions">
							<strong>Status : 
							 @if($row->status!='Y')
								Menunggu Pengembalian Resi / Uang
                            @else
								Pengiriman Sukses
                        	@endif
							</strong>
							
						</div>
						
					</div>
						<br>	
							<div class="row text-left">
								
							</div>
				</div>
							</div>
							<div class="modal-footer">
								@if($row->metode_bayar=='cash')
										@if($row->status=='N')
										<a href="{{url('/uangkembali/'.$row->id)}}" class="btn btn-rounded btn-success" onclick="return confirm('Apakah Uang Telah Diterima ?')">Lunas</a>
										<a href="{{url('/resikembali/'.$row->id)}}" class="btn btn-rounded btn-primary" onclick="return confirm('Apakah Resi Telah Kembali ?')">Resi Dikembalikan</a>
										@elseif($row->status=='US')
										<a href="{{url('/resikembali/'.$row->id)}}" class="btn btn-rounded btn-primary" onclick="return confirm('Apakah Resi Telah Kembali ?')">Resi Dikembalikan</a>
										@elseif($row->status=='RS')
										<a href="{{url('/uangkembali/'.$row->id)}}" class="btn btn-rounded btn-success" onclick="return confirm('Apakah Uang Telah Diterima ?')">Lunas</a>
										@endif
								@else
									@if($row->status=='N')
									<a href="{{url('/uangkembali/'.$row->id)}}" class="btn btn-rounded btn-success" onclick="return confirm('Apakah Uang Telah Diterima ?')">Uang Dikembalikan</a>
									<a href="{{url('/resikembali/'.$row->id)}}" class="btn btn-rounded btn-primary" onclick="return confirm('Apakah Resi Telah Kembali ?')">Resi Dikembalikan</a>
									@elseif($row->status=='US')
									<a href="{{url('/resikembali/'.$row->id)}}" class="btn btn-rounded btn-primary" onclick="return confirm('Apakah Resi Telah Kembali ?')">Resi Dikembalikan</a>
									@elseif($row->status=='RS')
									<a href="{{url('/uangkembali/'.$row->id)}}" class="btn btn-rounded btn-success" onclick="return confirm('Apakah Uang Telah Diterima ?')">Uang Dikembalikan</a>
									@endif
								@endif
								
								<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div><!--.modal-->
                            </td>
                            <td>{{$row->tgl}}</td>
                            <td>{{$row->pengiriman_via}}</td>
                            <td>{{$row->nama_barang}}</td>
                            <td>{{$row->kota_asal}} - {{$row->kode_tujuan}}
                            </td>
                            <td>{{$row->nama_pengirim}}</td>
                            <td>{{$row->admin}}</td>
                            <td class="text-center">
                            @if($row->pengiriman_via=='udara')
                            	@if($row->no_smu=='')
                            	<span class="label label-warning">Menunggu</span>
                            	@else
                            	@if($row->status=='Y')
		                            <span class="label label-success">
										Sukses
									</span>
	                            @else
									<span class="label label-warning">Menunggu</span>
	                        	@endif
                            	@endif
                            	
                            @else
                            	@if($row->status=='Y')
		                            <span class="label label-success">
										Sukses
									</span>
	                            @else
									<span class="label label-warning">Menunggu</span>
	                        	@endif
                            @endif
	                            
                            </td>
                            <td class="text-center">
                           	@if(Session::get('level')!='cs')
                            @if(Session::get('level')!='admin')
                            	@if($row->kode_jalan=='')
                            	<form action="{{ url('/Manual/delete')}}" method="post">
                            	<a href="{{url('/editresi/'.$row->id)}}" class="btn btn-warning btn-sm">
                                <i class="fa fa-wrench"></i>
                            	</a>
                                {{csrf_field()}}
                                <input type="hidden" name="aid" value="{{$row->id}}">
                                <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm">
                                <i class="fa fa-remove"></i>
                            	</button>
                            	<a href="{{url('/batalpengiriman/'.$row->id)}}" onclick="return confirm('Batalkan Pengiriman ?')" class="btn btn-primary btn-sm">
                                <i class="fa fa-ban"></i>
                            	</a>
                                </form>
                                @else
                                 <a href="{{url('/editresi/'.$row->id)}}" class="btn btn-warning btn-sm">
                                <i class="fa fa-wrench"></i>
                            	</a>
                                <a href="{{url('/batalpengiriman/'.$row->id)}}" onclick="return confirm('Batalkan Pengiriman ?')" class="btn btn-primary btn-sm">
                                <i class="fa fa-ban"></i>
                            	</a>
                                @endif
                            @else
                            -
                            @endif
                             @else
                            -
                            @endif
                            </td>
						</tr>
						@endforeach
						</tbody>
						<tfoot>
						<tr>
							<th>No</th>
							<th>No.Resi</th>
							<th>Tanggal</th>
							<th>Jalur</th>
							<th>Isi Paket</th>
							<th>Tujuan</th>
							<th>Pengirim</th>
							<th>Admin</th>
							<th>Status</th>
							<td>Aksi</td>
						</tr>
						</tfoot>
					</table>
					<a onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</a>
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
            "paging":true
        });
		});

	
	</script>
	@endsection