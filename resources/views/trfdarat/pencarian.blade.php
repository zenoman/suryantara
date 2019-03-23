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
							<h2 class = "page-header">Hasil Pencarian "{{$cari}}"</h2>
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
                    <a href="{{url('trfdarat')}}" class="btn btn-danger">Kembali</a>
					
                    <br><br>
                    <!-- <form action="hapusdata" method="post"> -->
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<a>List Data Tarif Darat</a>
						<thead>
						<tr>
							<th>No</th>
							<th>Kode Tujuan</th>
							<th>Tujuan</th>
							<th>Tarif</th>
							<th>Berat Minimal</th>
							<th>Estimasi</th>
							<th>Aksi</th>
							<th  class="text-center"><input type="checkbox" onclick="toggle(this)"/></th>
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
							<th>Aksi</th>
							<th  class="text-center"><input type="checkbox" onclick="toggle(this)"/></th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($trf_drt as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$row->kode}}</td>
                            <td>{{$row->tujuan}}</td>
                            <td>    {{"Rp ". number_format($row->tarif,0,',','.')}}</td>
                            <td>{{"Kg ".$row->berat_min}}</td>
                            <td>{{$row->estimasi." Hari"}}</td>
                            <td>                            	
<form action="{{url('/trfdarat/delete') }}"  method="post">
	<input type="hidden" name="" value="{{$url}}">
<a href="{{url('/trfdarat/'.$row->id.'/edit')}}" class="btn btn-rimary btn-sm"><i class="fa fa-pencil"></i> Edit Data</a>

                                        {{csrf_field()}}
                                        	<input type="hidden" name="aid" value="{{$row->id}}">
<button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm">
                                        <i class="fa fa-remove"></i>Hapus</button>
                    					</form>
                    			</td>
                            <form method="post" action="{{url('/trfdarat/hapuspilihan')}}">
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="id[]" value="{{$row->id}}" ></td>
						</tr>
						@endforeach
						</tbody>
					</table>
					<div class="text-right">

<input onclick="return confirm('Hapus Data Terpilih ?')" type="submit" name="submit" class="btn btn-danger" value="hapus pilihan">
					</div>
						{{csrf_field()}}
                        </form>
				
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
	  checkboxes = document.getElementsByName('id[]');
	  for(var i=0, n=checkboxes.length;i<n;i++) {
	    checkboxes[i].checked = source.checked;
	  }
	  }
	</script>
	@endsection