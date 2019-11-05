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
							<h2>Data Ditribusi Resi</h2>
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
					<a href="{{url('distribusiresi/create')}}" class="btn btn-primary">Tambah Data</a>
					<a href="{{url('distribusiresi/exsportexcel')}}" class="btn btn-success"><i class="fa fa-file-excel"></i> Import Excel</a>
                    <br><br>
                    <form action="{{url('gantistatus')}}" method="post">
					<table id="example" class="display table table-striped table-bordered" width="100%">
						<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">No Resi</th>
							<th class="text-center">Cabang</th>
							<th class="text-center">Pembuat</th>
							<th class="text-center">Status</th>
							<th class="text-center">Aksi</th>
							<th class="text-center">
								<input type="checkbox" onclick="toggle(this)"/>
							</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">No Resi</th>
							<th class="text-center">Cabang</th>
							<th class="text-center">Pembuat</th>
							<th class="text-center">Status</th>
							<th class="text-center">Aksi</th>
							<th class="text-center">#</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td class="text-center">{{$no}}</td>
                            <td class="text-center">{{$row->no_resi}}</td>
                            <td class="text-center">{{$row->nama}}</td>
                            <td class="text-center">{{$row->pembuat}}</td>
                            <td class="text-center">
                            	@if($row->status=='N')
                            		<span class="label label-warning">Tidak Aktiv</span>
                            	@else
                            		<span class="label label-success">Aktiv</span>
                            	@endif
                            </td>
                            <td class="text-center">
								<a href="{{url('hapusresi/'.$row->id)}}" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm">Hapus</a>
                    		</td>
                    		<td class="text-center">
                    			<input name="pilihid[]" type="checkbox" id="checkbox[]" value="{{$row->id}}">
                    		</td>
						</tr>
						@endforeach
						</tbody>
					</table>
					<div class="row">
						<div class="col-md-9 col-sm-9"></div>
						<div class="col-md-3 col-sm-3">
							<label>Data Terpilih</label>
							<div class="input-group">
								<select name="status" id="" class="form-control">
									<option value="hapus">Hapus</option>
									<option value="aktiv">Aktivkan</option>
								</select>
								{{csrf_field()}}
								<button type="submit" class="input-group-addon btn btn-succes">Simpan</button>
							</div>
						</div>
						
					</div>
					
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
            "paging":true,
            "columnDefs": [ {
          "targets": 6,
          "orderable": false,
    		} ]
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