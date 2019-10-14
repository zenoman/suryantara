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
							<h5>Berdasarkan No.Resi/SMU kosong</h5>
						</div>
					</div>
				</div>
			</header>

			<section class="card">
				<div class="card-block">
					@if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                        </button>
                        {{ session('status') }}
                    </div>
                    @endif
                   
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
							@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
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
							<!-- ini -->

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
								<div>Metode Bayar : {{$row->metode_bayar}}@if($row->tgl_lunas==null) - <b>Belum Lunas</b> @else - <b>Lunas</b> @endif</div>
							</div>
							<div>
                                @if($row->tgl_lunas!=null)
                                Tanggal Pelunasan : {{$row->tgl_lunas}}
                                @else
                                Tanggal Pelunasan : -
                                @endif  
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
								@if($row->duplikat!='Y')
								@if(Session::get('level') == '1' 
								|| Session::get('level') == '3'
								|| Session::get('level') == '5'
								|| Session::get('level') == '2'
								|| Session::get('level') == '9'
								|| Session::get('level') == '6')
										@if($row->status=='N')
										<a href="{{url('/resikembali/'.$row->id)}}" class="btn btn-rounded btn-primary" onclick="return confirm('Apakah Resi Telah Kembali ?')">Resi Dikembalikan</a>
										@endif
								@endif
								@endif
								<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div><!--.modal-->
                            </td>
                            <td>
                                <span class="label label-danger">
                                kosong
                                </span>
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
                            @if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
                            <td class="text-center">
                            	@if($row->duplikat!='Y')
                            	 
                            	@if($row->kode_jalan=='')
                            	<form action="{{ url('/Manual/delete')}}" method="post">
                            	<a href="{{url('/editresi/'.$row->id)}}" class="btn btn-warning btn-sm">
                                <i class="fa fa-wrench"></i>
                            	</a>
                            	
                                {{csrf_field()}}
                                <input type="hidden" name="aid" value="{{$row->id}}">
                                <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm">
                                <i class="fa fa-remove"></i></button>
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
                            <a href="{{url('/batalpengiriman/'.$row->id)}}" onclick="return confirm('Batalkan Pengiriman ?')" class="btn btn-primary btn-sm">
                                <i class="fa fa-ban"></i>
                            	</a>
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
							@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
							<th>Aksi</th>
							@endif
						</tr>
						</tfoot>
					</table>
					
					<a onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</a>
				</div>
			</section>
		</div>
	</div>
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