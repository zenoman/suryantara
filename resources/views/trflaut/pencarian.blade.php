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
							<h2>Data tarif Laut</h2>
							<p>Hasil Pencarian "{{$cari}}"</p>
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
                    <a href="{{url('trflaut')}}" class="btn btn-danger">Kembali</a>
					
                    <br><br>
                    <form action="{{url('/trflaut/hapuspilihan')}}" method="post">
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode Tujuan</th>
							<th>Tujuan</th>
							<th>Tarif</th>
							<th>Berat Minimal</th>
							<th>Estimasi</th>
							<th>Tarif Cabang</th>
							@if(Session::get('level') == '1' || 
		            		Session::get('level') == '3' || 
		            		Session::get('level') == '2')
							<th class="text-center">Aksi</th>
							<th class="text-center"><input type="checkbox" onclick="toggle(this)"/></th>
							@endif
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>Kode Tujuan</th>
							<th>Tujuan</th>
							<th>Tarif</th>
							<th>Berat Minimal</th>
							<th>Estimasi</th>
							<th>Tarif Cabang</th>
							@if(Session::get('level') == '1' || 
		            		Session::get('level') == '3' || 
		            		Session::get('level') == '2')
							<th class="text-center">Aksi</th>
							<th class="text-center"><input type="checkbox" onclick="toggle(this)"/></th>
							@endif
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($trflaut as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->kode}}</td>
                            <td>{{$row->tujuan}}</td>
                            <td>    {{"Rp ". number_format($row->tarif,0,',','.')}}</td>
                            <td>{{"Kg ".$row->berat_min}}</td>
                            <td>{{$row->estimasi." Hari"}}</td>
                            <td>{{$row->namacabang}}</td>
                            @if(Session::get('level') == '1' || 
		            		Session::get('level') == '3' || 
		            		Session::get('level') == '2')
                            <td class="text-center">
                            	<a href="{{url('/trflaut/'.$row->id.'/edit')}}" class="btn btn-rimary btn-sm">Edit</a>
                            </td>
                            <td align="center"><input name="pilihid[]" type="checkbox"  id="checkbox[]" value="{{$row->id}}"  ></td>
                            @endif
						</tr>
						@endforeach
						</tbody>
					</table>
					@if(Session::get('level') == '1' || 
            		Session::get('level') == '3' || 
            		Session::get('level') == '2')
					<div class="text-right">
						<input onclick="return confirm('Hapus Data Terpilih ?')" type="submit" name="submit" class="btn btn-warning btn-sm" value="hapus pilihan">
					</div>
					@endif
						{{csrf_field()}}
                        </form>
					 
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