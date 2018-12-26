@extends('layout.masteradmin')


@section('header')
@foreach($title as $row)
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
							<h2>Laporan Pemasukan</h2>
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
							<th>No resi</th>
							<th>tanggal</th>
							<th>jalur</th>
							<!-- <th>Aksi</th> -->
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>No resi</th>
							<th>tanggal</th>
							<th>jalur</th>
							<!-- <th>Aksi</th> -->
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->no_resi}}</td>
                            <td>{{$row->tgl}}</td>
                            <td>{{$row->pengiriman_via}}</td>
                            <!-- <td>
                            	<a href="{{url('admin/'.$row->id.'/changepas')}} " class="btn btn-warning btn-sm">
                                        <i class="fa fa-key"></i> Ganti Password</a>
                            	<a href="admin/{{$row->id}}" class="btn btn-rimary btn-sm">
                                        <i class="fa fa-pencil"></i> Edit Data</a>
                                <a  onclick="return confirm('Hapus Data ?')" href="admin/{{$row->id}}/delete" class="btn btn-danger btn-sm">
                                        <i class="fa fa-remove"></i>Hapus</a>
                            </td> -->
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>
<<<<<<< HEAD
		</div><!--.container-fluid-->
	</div><!--.page-content-->
=======
			@foreach($total as $ttl)
			<section class="card">
				<div class="card-block">
					<h2>Total <b>{{"Rp ".number_format($ttl->totalnya,0,',','.')}}</b></h2>
					<div class="pull-right">
						<form action="cetakpembelian" method="post">
							<input type="hidden" name="tahun" value="{{$bulanya}}">
							<input type="hidden" name="jalur" value="{{$jalur}}">
							{{@csrf_field()}}
							<button type="submit" class="btn btn-primary">
							Cetak
							</button>&nbsp;&nbsp;
							<button type="button" onclick="cetak()">
								cetak
							</button>	
							<button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</button>
						</form>
							
					</div>
				</div>
			</section>
			@endforeach
		</div>
	</div>
	<div id="hidden_div" style="display: none;">
		<table border="1" style="width: 100%">
						<thead>
						<tr>
							<th>No</th>
							<th>No resi</th>
							<th>tanggal</th>
							<th>Tujuan</th>
								@if($jalur=='semua')
									<th>jalur</th>
								@endif
							<th>pengirim</th>
							<th>penerima</th>
							<th>admin</th>
							<th>Subtotal</th>
							<!-- <th>Aksi</th> -->
						</tr>
						</thead>
						
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->no_resi}}</td>
                            <td>{{$row->tgl}}</td>
                            <td>{{$row->kota_asal}}-{{$row->kode_tujuan}}</td>
                            	@if($jalur=='semua')
								 <td>{{$row->pengiriman_via}}</td>
                            @endif
                            <td>{{$row->nama_pengirim}}</td>
                            <td>{{$row->nama_penerima}}</td>
							<td>{{$row->username}}</td>
							<td>{{"Rp ".number_format($row->total_biaya,0,',','.')}}</td>
                          
						</tr>
						@endforeach
						</tbody>
					</table>
	</div>
>>>>>>> master
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
		function cetak(){
			var divToPrint=document.getElementById('hidden_div');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print();window.close()">'+divToPrint.innerHTML+'</body></html>');
		newWin.document.close();
		}
	</script>
	@endsection