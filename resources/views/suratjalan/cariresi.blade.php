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
							<h2>List Resi Surat Jalan</h2>
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
                    @if (session('statuserror'))
                    <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('statuserror') }}
                    </div>
                    @endif
                    <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Resi</th>
							<th>Resi/SMU</th>
							<th>No. Surat Jalan</th>
							<th>Tanggal</th>
							<th>Status</th>
							<th class="no-sort">#</th>
							
						</tr>
						</thead>
						<tfoot>
							<tr>
								<th>No</th>
							<th>Resi</th>
							<th>Resi/SMU</th>
							<th>No. Surat Jalan</th>
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
                            <td>{{$row->no_resi}}</td>
                            <td>
                            	@if($row->no_smu=='')
                            	<span class="label label-danger">
								Kosong
								</span>
                            	@else
                            	{{$row->no_smu}}
								@endif
                            </td>
                            <td>{{$row->kode_jalan}}</td>
                            <td>{{$row->tgl}}</td>
                            <td>
                            	@if($row->cabang=='Y')
								Rp. {{number_format($row->biaya_suratjalan,0,',','.')}}
                            	@else
                            	@if($row->biaya_suratjalan>0)
                            	Rp. {{number_format($row->biaya_suratjalan,0,',','.')}}
                            	@else
                            	<span class="label label-danger">
								Belum Lunas
								</span>
                            	@endif
                            	@endif
                            </td>
                           <td>
                           	@if($row->cabang=='Y')
                           	<button class="btn btn-sm btn-primary"
						data-toggle="modal"
						data-target=".bd-example-modal-lg{{$row->id}}"><i class="fa fa-eye"></i></button>

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
							 @if($row->status=='N')
								Menunggu Pengembalian Resi / Uang
                            @else
								Pengiriman Sukses
                        	@endif
							</strong>
							
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
                            @else
                           	@if($row->biaya_suratjalan>0)
                           	<button class="btn btn-sm btn-primary"
						data-toggle="modal"
						data-target=".bd-example-modal-lg{{$row->id}}"><i class="fa fa-eye"></i></button>

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
							 @if($row->status=='N')
								Menunggu Pengembalian Resi / Uang
                            @else
								Pengiriman Sukses
                        	@endif
							</strong>
							
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
                           	@else
                           	<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#Modal{{$row->id}}">
                     					<i class="fa fa-money"></i>
                     				</button>
                     				<div class="modal fade" id="Modal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
							value="{{$row->no_resi}}" 
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
							value="{{$row->no_smu}}" 
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
							<input type="hidden" name="nomer" value="{{$row->id}}">
							<input type="hidden" name="kode" value="{{$row->kode_jalan}}">
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
                           	@endif
                           @endif
                           </td>
						</tr>
						
						@endforeach
						</tbody>
					</table>
					<div class="pull-right">
					
					<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
					</div>
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
            "paging":true,
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