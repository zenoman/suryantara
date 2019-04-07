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
							<h2>Data Pembukuan</h2>
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
					<a href="{{url('pengeluaranlain/create')}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Tambah Data</a>
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>tanggal</th>
							<th>Kategori</th>
							<th>Jumlah</th>
							<th>Admin</th>
							<th>Keterangan</th>
							<th class="no-sort text-center">#</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>tanggal</th>
							<th>Kategori</th>
							<th>Jumlah</th>
							<th>Admin</th>
							<th>Keterangan</th>
							<th class="no-sort text-center">#</th>
						</tr>
						</tfoot> 
						<tbody>
						@php
							$nomer = 1;
						@endphp
						@foreach($data as $row)
						<tr>
							<td>{{$nomer++}}</td>
							<td>{{$row->tgl}}</td>
							<td>{{$row->kategori}}</td>
							<td>{{"Rp ".number_format($row->jumlah,0,',','.')}}</td>
							<td>
								{{$row->admin}}
							</td>
							<td>
								{{$row->keterangan}}
							</td>
							<td class="text-center">
								<button
								 class="btn btn-success edit-modal" type="button" 
								 onclick="return iwak()" 
								 data-tgl="{{$row->tgl}}" 
								 data-ket="{{$row->keterangan}}" 
								 data-admin="{{$row->admin}}" 
								 data-kat="{{$row->kategori}}"
								 data-gambar="{{$row->gambar}}"
								 data-jumlah="{{"Rp ".number_format($row->jumlah,0,',','.')}}">
									<i class="fa fa-eye"></i>
								</button>
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
								<h4 class="modal-title" id="myModalLabel">Detail Pengeluaran</h4>
							</div>
							<div class="modal-body">
								<div class="card-block invoice">
					<div class="row">
						<div class="col-lg-6 company-info">
							<h5 id="jumlahnya"></h5>
							<p>Kategori : <span id="katnya"></span></p>
						</div>
						<div class="col-lg-6 clearfix invoice-info">
							<div class="text-lg-right">
								<h5 id="tglnya"></h5>
								<div><strong>Pembuat :</strong> <span id="pembuatnya"></span></div>
							</div>

						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12 terms-and-conditions">
							<strong>Keterangan : </strong><br>
							<span id="ketnya">
								
							</span>
						</div>
						<div class="col-lg-12 text-center">
							<img src="" id="fotonya" width="50%">
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
            "paging":false,
            "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    		} ]
        });
		});
		$(document).on('click', '.edit-modal', function() {
          	$('#tglnya').html($(this).data('tgl'));
            $('#ketnya').html($(this).data('ket'));
            $('#pembuatnya').html($(this).data('admin'));
            $('#jumlahnya').html($(this).data('jumlah'));
            $('#katnya').html($(this).data('kat'));
             $("#fotonya").attr("src","img/nota/"+$(this).data('gambar'));
            $('.bd-example-modal-lg').modal('show');
        });

		function iwak(){
			$('.bd-example-modal-lg').modal('show');
		}
	</script>
	@endsection