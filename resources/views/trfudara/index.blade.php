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
							<h2>Data Tarif Udara</h2>
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
                    @elseif(session('statuserror'))
                    <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('statuserror') }}
                    </div>
                    @endif
                    @if(Session::get('level') == '1' || 
            		Session::get('level') == '3' || 
            		Session::get('level') == '2')
					<a href="{{url('trfudara/create')}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Tambah Data</a>
					<a href="{{url('trfudara/importexcel')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Import Excel</a>
					@else
					<a href="{{url('trfudara/exporttrfudara')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</a>
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
                                           <form method="get" action="{{url('trfudara/cari')}}">
                                            <div class="form-group">
                                                <input type="text" name="cari" class="form-control" placeholder="cari berdasarkan kode/tujuan/airlans" required>
                                            </div>
                                           {{csrf_field()}}
                                            <input type="submit" class="btn btn-info" value="Cari Data">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            
                                            </form>
                                        </div>
                                 
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                    <br><br>
<form action="{{url('/trfudara/hapuspilihan')}}" method="post">
					<table id="example" class="display table table-striped table-bordered " cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Tujuan</th>
							<th>Airlines</th>
							<th>Biaya perKg</th>
							<th>Biaya dokumen</th>
							<th>Heavy cargo</th>
							<th>Berat Minimal</th>
							<th>Tarif Cabang</th>
							<th class="text-center">Aksi</th>
							<th  class="text-center"><input type="checkbox" onclick="toggle(this)"/></th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>kode</th>
							<th>Tujuan</th>
							<th>Airlines</th>
							<th>Biaya perKg</th>
							<th>Biaya dokumen</th>
							<th>Heavy cargo</th>
							<th>Berat Minimal</th>
							<th>Tarif Cabang</th>
							<th class="text-center">Aksi</th>
							<th  class="text-center"><input type="checkbox" onclick="toggle(this)"/></th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($trf_udara as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->kode}}</td>
                            <td>{{$row->tujuan}}</td>
                            <td>{{$row->airlans}}</td>
                            <td>{{"Rp ". number_format($row->perkg,0,',','.')}}</td>
                            <td>{{"Rp ". number_format($row->biaya_dokumen,0,',','.')}}</td>
                            <td>{{$row->minimal_heavy. "kg"}}</td>
                            <td>{{$row->berat_minimal. "kg"}}</td>
                            <td>{{$row->namacabang}}</td>
                            <td class="text-center">
								<a href="{{url('/trfudara/'.$row->id.'/edit')}}" class="btn btn-rimary btn-sm">Edit</a>

                            </td>
                            <td align="center">&nbsp;&nbsp;&nbsp;<input name="pilihid[]" type="checkbox"  id="checkbox[]" value="{{$row->id}}"  ></td>
						</tr>
						@endforeach
						</tbody>
					</table>
						{{csrf_field()}}
						<div class="text-right">
								<a onclick="return confirm(' Kosongkan data?')" href="{{url('/trfudara/hapussemua')}}" class="btn btn-danger">
									Kosongkan Data
								</a>	
								&nbsp;&nbsp;
								<input onclick="return confirm('Hapus Data Terpilih ?')" type="submit" name="submit" class="btn btn-warning btn-sm" value="hapus pilihan">
						</div>
                        </form>
                        {{ $trf_udara->links() }}

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
		function toggle(source) {
	  checkboxes = document.getElementsByName('pilihid[]');
	  for(var i=0, n=checkboxes.length;i<n;i++) {
	    checkboxes[i].checked = source.checked;
	  }
	  }
	</script>
	@endsection