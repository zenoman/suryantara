@extends('layout.masteradminnew')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection

@section('content')
<script type="text/javascript">
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</script>
<div class="page-content">
		<div class="container-fluid">
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Edit Data Armada</h2>
						</div>
					</div>
				</div>
			</header>
			@foreach($armada as $row)
			<div class="box-typical box-typical-padding">
				
				<form action="{{ url('armada/'.$row->id) }}" role="form" method="POST">
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama Kendaraan</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input 
								type="text" 
								class="form-control" 
								placeholder="Contoh : Daihatsu Gran Max" name="nama"
								required 
								value="{{$row->nama}}"
								>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">No. Polisi</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								name="nopol" 
								required
								value="{{$row->nopol}}">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">No. Rangka</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								name="norangka" 
								required
								value="{{$row->nomor_rangka}}">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">No. Mesin</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								name="nomesin" 
								required
								value="{{$row->nomor_mesin}}">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Warna</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								name="warna" 
								required 
								placeholder="Contoh : Merah"
								value="{{$row->warna}}">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Cabang</label>
						<div class="col-sm-10">

							<div class="input-group">
							<select class="form-control" name="cabang">
								@foreach($cabang as $row2)
								<option value="{{$row2->id}}" @if($row->id_cabang==$row2->id) selected @endif>{{$row2->nama}}</option>
								@endforeach
								
							</select>
							</div>
						</div>
					</div>
					<input type="hidden" name="_method" value="PUT">
					{{csrf_field()}}
					<div class="text-right">
						<input class="btn btn-primary" type="submit" name="submit" value="simpan">
						<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
					</div>
				</form>
				
			</div>
			<div class="box-typical box-typical-padding">
				<h4>List Pajak Unit</h4>
				<hr>
				 @if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                    @endif
				<table id="table-edit" class="table table-bordered table-hover">
				<thead>
				<tr>
					<th width="1">
						#
					</th>
					<th>Nama Pajak</th>
					<th>Tanggal Bayar</th>
					<th>Tanggal Kadaluarsa</th>
					<th class="tabledit-toolbar-column"></th>
				</tr>
				</thead>
				<tbody>
					<?php $i = 1;?>
					@foreach($datapajak as $row2)
					<tr>
						<td>
							{{$i++}}
						</td>
						<td>
							{{$row2->nama_pajak}}
						</td>
						<td>
							{{$row2->tgl_bayar}}
						</td>
						<td>
							{{$row2->tgl_kadaluarsa}}
						</td>
					<td style="white-space: nowrap; width: 1%;">
					<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                        <div class="btn-group btn-group-sm" style="float: none;">
                        	<a href="#" class="tabledit-edit-button btn btn-sm btn-warning" style="float: none;" data-toggle="modal" data-target="#myModal{{$row2->id}}"><span class="glyphicon glyphicon-pencil"></span></a>
                        	<a href="{{url('/hapuspajakunit/'.$row2->id)}}" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;" onclick="return confirm('Hapus Data ?')"><span class="glyphicon glyphicon-trash"></span></a>
                        </div>
                        <div class="modal fade" id="myModal{{$row2->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
									<i class="font-icon-close-2"></i>
								</button>
								<h4 class="modal-title" id="myModalLabel">Edit Pajak</h4>
							</div>
							<div class="modal-body">
								<form action="{{url('/editpajakunit')}}" method="POST">
									<div class="form-group row">
									<div class="col-sm-12">
										<label class="form-control-label semibold">Nama Pajak</label>
										<div class="input-group">
											<input
											type="text"
											class="form-control"
											name="namapajak"
											value="{{$row2->nama_pajak}}" 
											required>
										</div>
									</div>
								</div>
								{{csrf_field()}}	
								
								<input type="hidden" name="idpajak" value="{{$row2->id}}">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-rounded btn-primary">Simpan</button>
								</form>
							</div>
						</div>
					</div>
				</div>
                    </div>
                </td>
                </tr>
					@endforeach

				</tbody>
			</table>
			<br>
			<div class="text-right">
						<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#buat">Tambah Pajak</a>
						<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
					</div>
					 <div class="modal fade" id="buat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
									<i class="font-icon-close-2"></i>
								</button>
								<h4 class="modal-title" id="myModalLabel">Tambah Pajak</h4>
							</div>
							<div class="modal-body">
								<form action="{{url('/tambahpajakunit')}}" method="POST">
									<div class="form-group row">
									<div class="col-sm-12">
										<label class="form-control-label semibold">Nama Pajak</label>
										<div class="input-group">
											<input
											type="text"
											class="form-control"
											name="namapajak"
											required>
										</div>
									</div>
								</div>
								{{csrf_field()}}	
								
								<input type="hidden" name="idunit" value="{{$row->id}}">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-rounded btn-primary">Simpan</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			</div>
			</div>
        @endsection
