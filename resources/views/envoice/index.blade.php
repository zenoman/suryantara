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
							<h2>List Invoice City kurier</h2>
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
					<a href="{{url('/envoice/tambah')}}" class="btn btn-primary"><i class="fa fa-eye"></i> Tambah Data</a>
					 <button class="btn btn-info" data-toggle="modal" data-target="#searchModal">
                     <i class="fa fa-search"></i> Cari Data</button>

                                <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Cari Data Spesifik Dari Semua Data</h4>
                                        </div>
                                        

                                        <div class="modal-body">
                                           <form method="get" action="{{url('carisuratenvoice')}}">
                                            <div class="form-group">
                                                <input type="text" name="cari" class="form-control" placeholder="cari berdasarkan Kode / Tujuan / Tanggal" required>
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
                    <form action="hapuslistenv" method="post">
                    	{{csrf_field()}}
                    <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Tujuan</th>
							<th>Tanggal</th>
							<th>Pembuat</th>
							<th class="text-center">Aksi</th>
							@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
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
							<th>Pembuat</th>
							<th class="text-center">Aksi</th>
							@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
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
                            <td>
                            	{{$row->pembuat}}
                            <td align="center">

                            	
                            	<button class="btn btn-primary btn-sm"
									data-toggle="modal"
									data-target=".bd-example-modal-lg{{$row->id}}" type="button"><i class="fa fa-eye"></i></button>
								<a href="{{url('cetakulangenvoice/'.$row->kode)}}" class="btn btn-success btn-sm" target="blank()"><i class="fa fa-print"></i></a>
                            </td>
                            @if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
                            <td>
								<input type="checkbox" name="delid[]" class="case" value="{{$row->id}}" />
							</td>
							@endif
						</tr>
						@endforeach
						</tbody>
					</table>
					<div class="pull-right">
						@if(Session::get('level') == '1' || Session::get('level') == '3' || Session::get('level') == '2')
						<button type="submit" onclick="return confirm('Hapus Data Yang Dipilih ?')" class="btn btn-warning">Hapus Data Terpilih
					</button>
					@endif
					<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
					</div>
					
					</form>
					 {{ $data->links() }}
				</div>
			</section>
		</div>
	</div>
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
							<p>Pembuat : {{$row->pembuat}}</p>


							<div class="invoice-block">
								<h5>Tujuan:</h5>
								<div>{{$row->tujuan}}</div>
								<div>
									{{$row->alamat}}
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
									->where('kode_envoice',$row->kode)
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
								</tr>
								</tbody>
							</table>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12 terms-and-conditions">
							
							
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