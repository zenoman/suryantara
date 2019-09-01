@extends('layout.masteradminnew')


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
							<h2>List Resi Antaran</h2>
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
                    @if (session('statuserror'))
                    <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('statuserror') }}
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
                                           <form method="get" action="{{url('cariresisuratantar')}}">
                                            <div class="form-group">
                                                <input type="text" name="cari" class="form-control" placeholder="cari berdasarkan Resi / no. surat antar / Pemegang / Tanggal" required>
                                            </div>
                                           {{csrf_field()}}
                                            <input type="submit" class="btn btn-info" value="Cari Data">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            
                                            </form>
                                        </div>
                                 
                                    </div>
                                </div>
                            </div> 
                    <br><br>
                   
                    <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Resi</th>
							<th>Pemegang</th>
							<th>No. Surat Antar</th>
							<th>Tanggal</th>
							<th>Status</th>
							<th class="no-sort">#</th>
							
						</tr>
						</thead>
						<tfoot>
							<tr>
								<th>No</th>
							<th>Resi</th>
							<th>Pemegang</th>
							<th>No. Surat Antar</th>
							<th>Tanggal</th>
							<th>Status</th>
							<th class="no-sort">#</th>
							</tr>
							
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>
                            	@if($row->batal=='N')
                            	{{$row->no_resi}}
                            	@else
                            	<span class="text-danger">
                            		{{$row->no_resi}}
                            	</span>
                            	@endif
                            </td>
                            <td>
                            	{{$row->pemegang}}
                            </td>
                            <td>{{$row->kode_antar}}</td>
                            <td>{{$row->tgl}}</td>
                            <td>
                            	@if($row->status_pengiriman=='menuju alamat tujuan')
                            		<span class="label label-primary">
                            		{{$row->status_pengiriman}}
                            		</span>
                            	@elseif($row->status_pengiriman=='pengantaran ulang')
                            		<span class="label label-warning">
                            		{{$row->status_pengiriman}}
                            		</span>
                            	@elseif($row->status_pengiriman=='dikembalikan ke pengirim')
                            		<span class="label label-danger">
                            			{{$row->status_pengiriman}}
                            		</span>
                            	@else
                            		<span class="label label-success">
                            			{{$row->status_pengiriman}}
                            		</span>
                            	@endif
                            </td>
                           <td>
                           		
									@if($row->status_antar=='P')
										<a href="{{url('/suksesantar/'.$row->id.'/'.$row->kode_antar)}}" class="btn btn-success btn-sm" onclick="return confirm('Apakah Resi Sudah Sampai Di Tujuan ?')"><i class="fa fa-check"></i>
										</a>

										<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Modal{{$row->id}}">
                     					<i class="fa fa-close"></i>
                     					</button>
                     					<a href="{{url('/returresi/'.$row->id.'/'.$row->kode_antar)}}" class="btn btn-danger btn-sm" onclick="return confirm('Retur Resi ?')"><i class="fa fa-ban"></i>
										</a>

                     			<div class="modal fade" id="Modal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Pengantaran Gagal</h4>
                                        </div>
                                        <div class="modal-body">
                                           <form method="post" action="{{url('/cancelresiantar')}}">
                                           	<div class="row">
                                           		<div class="col-lg-12">
													<fieldset class="form-group">
														<label class="form-label semibold" for="exampleInput">No. Resi</label>
														<input 
														type="text"
														class="form-control" 
														readonly 
														value="{{$row->no_resi}}">
														<input type="hidden" name="kode_antar" value="{{$row->kode}}">
														<input type="hidden" name="id_resi" value="{{$row->id}}">
													</fieldset>
												</div>
												<div class="col-lg-12">
													<fieldset class="form-group">
														<label class="form-label semibold" for="exampleInput">Keterangan</label>
														<select name="keterangan" class="form-control">
															<option value="Alamat salah atau tidak lengkap">
																Alamat salah atau tidak lengkap
															</option>
															<option value="Tempat penerima tutup">
																Tempat penerima tutup
															</option>
															<option value="Kurir salah mengambil rute">
																Kurir salah mengambil rute
															</option>

														</select>
													</fieldset>
												</div>
												<div class="col-lg-12">
													<fieldset class="form-group">
														<label class="form-label semibold" for="exampleInput">Keterangan Lain</label>
														<input type="text" name="ketlain" class="form-control">
													</fieldset>
												</div>
												<div class="col-lg-12">
													<fieldset class="form-group">
													{{csrf_field()}}
                                            		<input type="submit" class="btn btn-info" value="Simpan">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
													</fieldset>
												</div>
                                            
											</div>
											</form>
										</div>
                                            
                                        </div>
                                 	</div>
                                </div>
									@else
										<button class="btn btn-sm btn-primary"
										data-toggle="modal"
										data-target=".bd-example-modal-lg{{$row->id}}">
										<i class="fa fa-eye"></i>
										</button>
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
										<td class="text-right">Rp. {{number_format($row->biaya_kirim,2,',','.')}}</td>
										
									</tr>
								@if($row->pengiriman_via=='udara')
									<tr>
										<td class="text-right">Biaya SMU</td>
										<td class="text-right">Rp. {{number_format($row->biaya_smu,2,',','.')}}</td>
									</tr>
									<tr>
										<td class="text-right">Biaya Karantina</td>
										<td class="text-right">Rp. {{number_format($row->biaya_karantina,2,',','.')}}</td>
									</tr>
									<tr>
										<td class="text-right">Biaya Charge</td>
										<td class="text-right">Rp. {{number_format($row->biaya_charge,2,',','.')}}</td>
									</tr>
								@else
									<tr>
										<td class="text-right">Biaya Packing</td>
										<td class="text-right">Rp. {{number_format($row->biaya_packing,2,',','.')}}</td>
									</tr>
									<tr>
										<td class="text-right">Biaya Asuransi</td>
										<td class="text-right">Rp. {{number_format($row->biaya_asuransi,2,',','.')}}</td>
									</tr>
								@endif
									
									<tr>
										
										<td class="text-right">PPN</td>
										<td class="text-right">Rp. {{number_format($row->biaya_ppn,2,',','.')}}</td>
										
									</tr>
									<tr>
										<td><h4>Total</h4></td>
										<td class="text-right"><h4>
											Rp. {{number_format($row->total_biaya,2,',','.')}}
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
							{{$row->status_pengiriman}}
							</strong>
							@if($row->status_pengiriman=='pengantaran ulang')
							<strong>Keterangan : 
							{{$row->keterangan}}
							</strong>
							@endif
						</div>
						
					</div>
				</div>
							</div>
							<div class="modal-footer">
							
								<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div> 
									@endif
								
                           

                          
				
                           </td>
						</tr>
						
						@endforeach
						</tbody>
					</table>
					<div class="pull-right">
					
					<a href="{{url('/listantaran')}}" class="btn btn-danger">Kembali</a>
					</div>
					
					 {{ $data->links() }}
				</div>
			</section>
		</div><!--.container-fluid-->
	</div>
	@endsection

		@section('js')
	<script src="{{asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>
	<script>
		$(function() {
			$('#example').DataTable({
            responsive: true,
            "paging":false,
            "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    		} ]
        });
		});

	</script>
	<script language="javascript">
    $(function(){
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){

        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }

    });
});
</script>
	@endsection