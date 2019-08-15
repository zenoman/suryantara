@extends('layout.masteradminnew')

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
							<h2>Data Armada</h2>
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
					<a href="{{url('/armada/create')}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Tambah Data</a>
                    <br><br>
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Nopol</th>
							<th>Warna</th>
							<th>Cabang</th>
							<th class="text-center">Aksi</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Nopol</th>
							<th>Warna</th>
							<th>Cabang</th>
							<th class="text-center">Aksi</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($armada as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>
                            	<?php
                            	$now = date('Y-m-d');
                            	?>
                            	<!-- <span class='label label-danger'> -->
                            	 	{{$row->nama}}
                            	<!-- </span> -->
                            </td>
                            <td>{{$row->nopol}}</td>
                            <td>{{$row->warna}}</td>
                            <td>{{$row->namacabang}}</td>
                            <td class="text-center">
                            	<a href="{{url('armada/'.$row->id.'/bayarpajak')}}" class="btn btn-success btn-sm">
								<i class="fa fa-money"></i>
                            	</a>
                             	<a 
                             	href="#" 
                             	class="btn btn-info btn-sm edit-modal" 
                             	data-nama="{{$row->nama}}"
                             	data-warna="{{$row->warna}}"
                             	data-nopol="{{$row->nopol}}"
                             	data-mesin="{{$row->nomor_mesin}}"
                             	data-rangka="{{$row->nomor_rangka}}"
                             	data-idunit="{{$row->id}}"
                             	>
                             		<i class="fa fa-eye"></i>
                             	</a>
                            	<a href="{{url('/armada/'.$row->id.'/edit')}}" class="btn btn-warning btn-sm"><i class="fa fa-wrench"></i></a>
                                <a href="{{url('/armada/'.$row->id.'/delete')}}" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm">
                                  <i class="fa fa-remove"></i>
                                </a>
                            </td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>
		</div>
	</div>
	<div class="modal fade bd-example-modal-lg"
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
								<h4 class="modal-title" id="myModalLabel">Detail Unit</h4>
							</div>
							<div class="modal-body">
								<div class="card-block invoice">
					<div class="row">
						<div class="col-lg-6 company-info">
							<p>
								<strong>Nama :</strong>
								<span id="namanya"></span>
								<br>
								<strong>Warna :</strong>
								<span id="warnanya"></span>
								<br>
								<strong>No. Polisi :</strong>
								<span id="nopolnya"></span>
							</p>
						</div>
						<div class="col-lg-6 clearfix invoice-info">
							<div class="text-lg-right">
								<strong>No. Mesin :</strong> <span id="nomesinnya"></span>
								<br>
								<strong>No. Rangka :</strong> <span id="norangkanya"></span>
								<br>
								
							</div>
						</div>
						<hr>
						<div class="col-lg-12">
							<table id="table-sm" class="table table-bordered table-hover table-sm">
				<thead>
				<tr>
					<th class="text-center">
						#
					</th>
					<th class="text-center">Nama Pajak</th>
					<th class="text-center">Tanggal Bayar</th>
					<th class="text-center">Tanggal Kadaluarsa</th>
				</tr>
				</thead>
				<tbody id="tubuhnya">
				<tr>
					<td colspan="4">
						<span class="text-muted text-center">Loading...</span>
					</td>
				</tr>
				</tbody>
			</table>
						</div>
					</div>
				</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
								
							</div>
						</div>
					</div>
				</div><!--.modal-->
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
		$(document).on('click', '.edit-modal', function() {
			$('#tubuhnya').html('<tr><td colspan="4" align="center"><span class="text-muted text-center">Loading...</span></td></tr>');
          	$('#namanya').html($(this).data('nama'));
            $('#warnanya').html($(this).data('warna'));
            $('#nopolnya').html($(this).data('nopol'));
            $('#nomesinnya').html($(this).data('mesin'));
            $('#norangkanya').html($(this).data('rangka'));
             $.ajax({
                type:'GET',
                dataType:'json',
                url: 'caripajakunit/'+$(this).data('idunit'),
                success:function(data){
                var rows ='';
                var no=0;
                    $.each(data,function(key, value){

                    	var tgl_bayar ='' 
                        no +=1;
                        rows = rows + '<tr>';
                        rows = rows + '<td class="text-center">' +no+'</td>';
                        rows = rows + '<td class="text-center">' +value.nama_pajak+'</td>';
                        if (value.tgl_bayar==null) {
                    	rows = rows + '<td class="text-center">-</td>';
                    	}else{
                    	rows = rows + '<td class="text-center">'+value.tgl_bayar+'</td>';	
                    	}
                        if (value.tgl_kadaluarsa==null) {
                        rows = rows + '<td class="text-center">-</td>';
                        }else{
                        rows = rows + '<td class="text-center">'+value.tgl_kadaluarsa+'</td>';	
                        }
                        
                        rows = rows + '</tr>';
                });
                     $('#tubuhnya').html(rows);
                }
            });
            $('.bd-example-modal-lg').modal('show');
        });
	</script>
	@endsection