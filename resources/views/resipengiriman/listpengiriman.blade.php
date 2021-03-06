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
                     <div class="btn-group">
								<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="font-icon font-icon-eye"></i>	Tampil Berdasarkan
								</button>
								<div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
									<a class="dropdown-item" href="{{url('listpengirimanbatal')}}">
									Resi Dibatalkan</a>
									<a class="dropdown-item" href="{{url('listpengiriman_smukosong')}}">Resi/Smu kosong</a>
									
								</div>
							</div>
							@if(
							Session::get('level') == '1' || 
							Session::get('level') == '3' || 
							Session::get('level') == '2' || 
							Session::get('level') == '9' || 
							Session::get('level') == '6')
							<a href="{{url('updatepembayaranresi')}}" class="btn btn-success">
                     			<i class="fa fa-money"></i> Update Pembayaran
                     		</a>
                     		@endif
                     		
                                <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Cari Data Spesifik Dari Semua Data</h4>
                                        </div>
                                        

                                        <div class="modal-body">
                                           <form method="get" action="{{url('cariresipengiriman')}}">
                                            <div class="form-group">
                                                <input type="text" name="cari" class="form-control" placeholder="cari berdasarkan Resi/ Tanggal/ Jalur/ Tujuan/ Admin" required>
                                            </div>
                                           {{csrf_field()}}
                                            <input type="submit" class="btn btn-info" value="Cari Data">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            
                                            </form>
                                        </div>
                                 
                                    </div>
                                </div>
                            </div> 

                    
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>No.Resi</th>
							<th>Resi/SMU</th>
							<th>Tanggal</th>
							<th>Jalur</th>
							<th>Isi Paket</th>
							<th>Tujuan</th>
							<th>Pengirim</th>
							<th>Admin</th>
							<th>Status</th>
							 @if(
							 Session::get('level') == '1' || 
							 Session::get('level') == '3' || 
							 Session::get('level') == '2' ||
							 Session::get('level') == '6' ||
							 Session::get('level') == '9' )
							<th>Aksi</th>
							@endif
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
							<h5 style="margin-bottom: 0.2rem;">Isi paket : {{$row->nama_barang}}</h5>
							<p>No. SMU : {{$row->no_smu}}</p>
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
							<div>Maskapai : {{$row->maskapai_udara}}</div>
							<div>Metode Bayar : {{$row->metode_bayar}} @if($row->tgl_lunas==null) - <b>Belum Lunas</b> @else - <b>Lunas</b> @endif</div>
							</div>
							<div>
                                Tanggal Pelunasan : {{$row->tgl_lunas}}
                                </div>
							<br>
						</div>
						<div class="col-lg-6 clearfix invoice-info">
							<div class="text-lg-right">
								<h5>{{$row->no_resi}}</h5>
								@if($row->pengiriman_via!='udara')
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
								@else
									@if($row->dimensi!='-')
									<div>Operator : {{$row->admin}}</div>
									<table class="pull-right table-sm">
									
									<tr>
										<td>Dimensi</td>
										<td>Volumetrik</td>
										<td>Berat Aktual</td>
									</tr>
									<?php 
									$datavolumetrik = explode(',',$row->ukuran_volume);
									$datadimensi = explode(',', $row->dimensi);
									$databerat = explode(',',$row->berat);
									for ($nomor=0; $nomor < $row->jumlah ; $nomor++) { ?> 
										<tr>
											<td>{{$datadimensi[$nomor]}}</td>
											<td>{{$datavolumetrik[$nomor]}}</td>
											<td>{{$databerat[$nomor]}}</td>
										</tr>
									<?php } ?>
									<tr>
										<td colspan="3" class="text-center">Total : {{$row->total_berat_udara}} Kg</td>
									</tr>
									<tr>
										<td colspan="3" class="text-center">Jumlah : {{$row->jumlah}} Koli</td>
									</tr>
								</table>
								@endif
								@endif
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
									<tr>
										<td class="text-right">Biaya Charge</td>
										<td class="text-right">Rp. {{number_format($row->biaya_charge,0,',','.')}}</td>
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
										
										<td class="text-right"><b>Dibayar</b></td>
										<td class="text-right"><b>Rp. {{number_format($row->total_bayar,0,',','.')}}</b></td>
										
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
								Menunggu Pengembalian Resi
                            @else
								Pengiriman Sukses
                        	@endif
							</strong>
							
						</div>
						
					</div>
						<br>	
							<div class="row">
								@if($row->duplikat!='Y')
								@if(Session::get('level') == '1' 
								|| Session::get('level') == '3'
								|| Session::get('level') == '5'
								|| Session::get('level') == '2'
								|| Session::get('level') == '9'
								|| Session::get('level') == '6')
								<div class="col-md-6">
									<form action="tambahsmu" method="post">
									<label>Ubah No.Resi/SMU</label>
									<div class="input-group input-group-sm">
										<input type="text" value="" name="nosmu" class="form-control" style="display: block;" required>
										<input type="hidden" name="kode" value="{{$row->id}}">
										{{csrf_field()}}
										<span class="input-group-btn">
											<button class="btn btn-primary" type="submit">Simpan</button>
										</span>
									</div>
								</form>
								</div>
								@if($row->status=='N')
								<div class="col-md-6">
								<form action="{{url('/resikembali/'.$row->id)}}" method="post">
									<label>Resi Diterima (Masukan Keterangan)</label>
									<div class="input-group input-group-sm">
										<input type="text" name="keterangan" class="form-control" style="display: block;" required>
										{{csrf_field()}}
										<span class="input-group-btn">
											<button class="btn btn-success" type="submit">Ubah</button>
										</span>
									</div>
								</form>
							</div>
								@endif
								@endif
								@endif
							</div>
				</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
                            </td>
                            <td>
                            @if($row->no_smu=='')
                                @if($row->total_biaya != 0)
                                <span class="label label-danger">
                                kosong
                                </span>
                                @endif
                                @else
                                {{$row->no_smu}}
                                @endif
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
                            @if(
							 Session::get('level') == '1' || 
							 Session::get('level') == '3' || 
							 Session::get('level') == '2' ||
							 Session::get('level') == '6' ||
							 Session::get('level') == '9' )
                            <td class="text-center">
                            @if($row->duplikat!='Y')
								@if(Session::get('level') == '1' || 
							 		Session::get('level') == '3' || 
							 		Session::get('level') == '2' )
			                            <form action="{{ url('/Manual/delete')}}" method="post">
			                            		{{csrf_field()}}
			                                	<input type="hidden" name="aid" value="{{$row->id}}">
				                                <a href="{{url('/editresi/'.$row->id)}}" class="btn btn-warning btn-sm">
				                                	<i class="fa fa-wrench"></i>
				                            	</a>
				                                <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm">
				                                	<i class="fa fa-remove"></i>
				                            	</button>
				                               

			                                <a href="{{url('/batalpengiriman/'.$row->id)}}" onclick="return confirm('Batalkan Pengiriman ?')" class="btn btn-primary btn-sm">
			                                <i class="fa fa-ban"></i>
			                            	</a>
			                            </form>
                                @elseif(
                                Session::get('level') == '6' ||
							 	Session::get('level') == '9')
									@if($row->status!='Y')
									@if($row->kode_jalan=='')
		                            	<a href="{{url('/editresi/'.$row->id)}}" class="btn btn-warning btn-sm">
			                                <i class="fa fa-wrench"></i>
			                            </a>
			                               

		                                <a href="{{url('/batalpengiriman/'.$row->id)}}" onclick="return confirm('Batalkan Pengiriman ?')" class="btn btn-primary btn-sm">
		                                <i class="fa fa-ban"></i>
		                            	</a>
                                	@endif
								@endif
							@endif
                            @endif
                           
                            </td>
                             @endif
						</tr>
						@endforeach
						</tbody>
						<tfoot>
						<tr>
							<th>No</th>
							<th>No.Resi</th>
							<th>Resi/SMU</th>
							<th>Tanggal</th>
							<th>Jalur</th>
							<th>Isi Paket</th>
							<th>Tujuan</th>
							<th>Pengirim</th>
							<th>Admin</th>
							<th>Status</th>
							 @if(Session::get('level') == '1' || 					Session::get('level') == '3' || 					Session::get('level') == '2' ||
							 	 Session::get('level') == '6' ||
							 	 Session::get('level') == '9' )
							<th>Aksi</th>
							@endif
						</tr>
						</tfoot>
					</table>
					{{ $datakirim->links() }}
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