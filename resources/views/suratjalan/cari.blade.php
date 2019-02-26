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
					
                    <form action="hapuslistsj" method="post">
                    	{{csrf_field()}}
                    <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Tujuan</th>
							<th>Tanggal</th>
							<th>Status</th>
							<th>Aksi</th>
							@if(Session::get('level') != 'admin')
							<th class="no-sort"><input type="checkbox" id="selectall"/></th>
							@endif
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
							@if(Session::get('level') != 'admin')
							<th>#</th>
							@endif
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->kode}}</td>
                            <td>
                            @php
                            	$newtujuan = explode("-", $row->tujuan);
                            @endphp
                            	{{$newtujuan[0]}}
                            </td>
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

                            	@if($row->status=='Y')
                            	<a href="{{url('/bayarsuratjalan/'.$row->id)}}" class="btn btn-warning btn-sm">
                            	Bayar Sekarang
                            	</a>
                            	@else
                            	<button class="btn btn-primary btn-sm"
									data-toggle="modal"
									data-target=".bd-example-modal-lg{{$row->id}}" type="button">Lihat Detail</button>
                            	@endif
                    			

						
                            </td>
                            @if(Session::get('level') != 'admin')
                            <td>
								<input type="checkbox" name="delid[]" class="case" value="{{$row->id}}" />
							</td>
							@endif
						</tr>
						@endforeach
						</tbody>
					</table>
					<div class="pull-right">
						@if(Session::get('level') != 'admin')
						<button type="submit" onclick="return confirm('Hapus Data Yang Dipilih ?')" class="btn btn-warning">Hapus Data Terpilih
					</button>
					@endif
					<a href="{{url('/listsuratjalan')}}" class="btn btn-danger">Kembali</a>
					</div>
					</form>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	 @foreach($data as $row)
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
					<br>
					<div class="row">
						<div class="col-lg-12 terms-and-conditions">
							<strong>Status : </strong>
							@if($row->status=='Y')
							Surat Jalan Belum Di lunasi
							@else
							Surat Jalan Telah Lunas
							@endif
							
						</div>
						
					</div>
							</div>
							<div class="modal-footer">
								
								<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div><!--.modal-->
	 @endforeach
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