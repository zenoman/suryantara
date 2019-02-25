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
                    <a href="{{url('trfudara')}}" class="btn btn-danger">Kembali</a>
					
                    <br><br>
<form action="{{url('/trfudara/hapuspilihan')}}" method="post">
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Kode Tujuan</th>
							<th>Tujuan</th>
							<th>Airlans</th>
							<th>Biaya perKg</th>
							<th>Biaya documen</th>
							<th>Min Heavy cargo</th>
							<th>Berat Minimal</th>
							<th>Aksi</th>
							<th  class="text-center"><input type="checkbox" onclick="toggle(this)"/></th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
							<th>Kode Tujuan</th>
							<th>Tujuan</th>
							<th>Airlans</th>
							<th>Biaya perKg</th>
							<th>Biaya documen</th>
							<th>Min Heavy cargo</th>
							<th>Berat Minimal</th>
							<th>Aksi</th>
							<th  class="text-center"><input type="checkbox" onclick="toggle(this)"/></th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($trf_udr as $row)
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
                            <td>
<form action="{{url('/trfudara/delete') }}"  method="post">
<a href="{{url('/trfudara/'.$row->id.'/edit')}}" class="btn btn-rimary btn-sm"><i class="fa fa-pencil"></i></a>

                                        {{csrf_field()}}
                                        	<input type="hidden" name="aid" value="{{$row->id}}">
<button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>
                    			</form>
                            </td>
                            <td align="center">&nbsp;&nbsp;&nbsp;<input name="pilihid[]" type="checkbox"  id="checkbox[]" value="{{$row->id}}"  ></td>
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
	  checkboxes = document.getElementsByName('pilihid[]');
	  for(var i=0, n=checkboxes.length;i<n;i++) {
	    checkboxes[i].checked = source.checked;
	  }
	  }
	</script>
	@endsection