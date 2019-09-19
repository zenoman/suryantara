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
							<h2>Data Tarif City Kurier</h2>
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
						<a href="{{url('trfcity/create')}}" class="btn btn-primary">Tambah Data</a>
						<a href="{{url('trfcity/importexcel')}}" class="btn btn-success">Export Import Excel</a>
					@endif
					<button class="btn btn-info" data-toggle="modal" data-target="#searchModal">Cari Data</button>
					 <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Cari Data Spesifik Dari Semua Data</h4>
                                        </div>
                                        <div class="modal-body">
                                           <form method="get" action="{{url('caritrfcity')}}">
                                            <div class="form-group">
                                                <input type="text" name="cari" class="form-control" placeholder="cari berdasarkan kode/tujuan/tarif" required autofocus>
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

                    <br>
					<form action="{{url('/trfcity/hapuspilihan')}}" method="post">
                    <br>
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Tujuan</th>
							<th>Tarif</th>
							<th>Berat Minimal</th>
							<th>Estimasi</th>
							<th>Tarif Cabang</th>
							<th>Status Tarif</th>
							 @if(Session::get('level') == '1' || 
		            		Session::get('level') == '3' || 
		            		Session::get('level') == '2') 
							<th class="text-center">Aksi</th>
							<th  class="text-center"><input type="checkbox" onclick="toggle(this)"/></th>
							@endif
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>kode</th>
							<th>Tujuan</th>
							<th>Tarif</th>
							<th>Berat Minimal</th>
							<th>Estimasi</th>
							<th>Tarif Cabang</th>
							<th>Status Tarif</th>
							 @if(Session::get('level') == '1' || 
            				Session::get('level') == '3' || 
            				Session::get('level') == '2') 
							<th class="text-center">Aksi</th>
							<th  class="text-center"><input type="checkbox" onclick="toggle(this)"/></th>
							@endif
						</tr>
						</tfoot> 
						<tbody>
						<?php $i = 1;?>
                            @foreach($trf_drt as $row)
                            <?php $no = $i++;?>
                        <tr >
                            <td>{{$no}}</td>
                            <td>{{$row->kode}}</td>
                            <td>{{$row->tujuan}}</td>
                            <td>{{"Rp ". number_format($row->tarif,0,',','.')}}</td>
                            <td>{{"Kg ".$row->berat_min}}</td>
                            <td>{{$row->estimasi." Hari"}}</td>
                            <td>{{$row->namacabang}}</td>
                            <td>@if($row->company=='Y') Company @else Personal @endif</td>
                             @if(Session::get('level') == '1' || 
		            		Session::get('level') == '3' || 
		            		Session::get('level') == '2') 
                            <td class="text-center">
							<a href="{{url('/trfcity/'.$row->id.'/edit')}}" class="btn btn-success btn-sm">Edit</a>
                                    
                            </td>
                            <td align="center">&nbsp;&nbsp;&nbsp;<input name="pilihid[]" type="checkbox"  id="checkbox[]" value="{{$row->id}}"  ></td>
							@endif
						</tr>
						@endforeach
						</tbody>
					</table>
					 @if(Session::get('level') == '1' || 
            		Session::get('level') == '3' || 
            		Session::get('level') == '2') 
					<div class="text-right">
&nbsp;&nbsp;
<a onclick="return confirm(' Kosongkan data?')" href="{{url('/trfcity/hapussemua')}}" class="btn btn-danger btn-sm">
Kosongkan Data
</a>	
&nbsp;&nbsp;
<input onclick="return confirm('Hapus Data Terpilih ?')" type="submit" name="submit" class="btn btn-warning btn-sm" value="hapus pilihan">
					</div>
					@endif
						{{csrf_field()}}
                        </form>
			{{ $trf_drt->links() }}
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