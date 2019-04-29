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
							<h2>Absensi Karyawan</h2>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				   
				<div class="card-block">
					
                    <br><br>
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th><div>No.</div></th>
	                        <th><div>Id Karyawan</div></th>
	                        <th><div>Nama</div></th>
	                        <th><div>Masuk</div></th>
	                        <th><div>Izin</div></th>
	                        <th><div>Tidak Masuk</div></th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th><div>No.</div></th>
	                        <th><div>Id Karyawan</div></th>
	                        <th><div>Nama</div></th>
	                        <th><div>Masuk</div></th>
	                        <th><div>Izin</div></th>
	                        <th><div>Tidak Masuk</div></th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($karyawan as $row)
                            <?php $no = $i++;?>
                        <tr>
	                            	<td>
	                                	{{$no}}
	                                </td>
	                                <td>{{$row->kode}}</td>
	                                <td>{{$row->nama}}</td>
	                                	@if($row->id == $row->id_karyawan )
	                                	<td>
	                                <span class="label label-secondary">
                                        Sudah Absen
                                    </span>
	                                	</td>
	                                	<td>
	                                <span class="label label-secondary">
                                        Sudah Absen
                                    </span>
	                                	</td>
	                                	<td>
	                                <span class="label label-secondary">
                                        Sudah Absen
                                    </span>
	                                	</td>
	                                	@else
	                                <td>
	                        	<form method="POST" action="{{url('/tamabsen')}}" role="form" class="form-horizontal form-bordered" id="forminput">
	                        		<input type="hidden" name="id_karyawan" id="id_karyawan" value="{{$row->id}}">
	                        		<input type="hidden" name="id_jabatan" id="id_jabatan" value="{{$row->id_jabatan}}">
	                        		<input type="hidden" name="uangmaem" id="uangmaem" value="{{$row->uang_makan}}">
	                        		<input type="hidden" name="tanggal" id="tanggal" value="{{$tanggal}}">
	                        		<input type="hidden" name="ma_tima" id="tahun" value="masuk">
	                        		{{csrf_field()}}
	                              <button type="submit" name="submit" class="btn btn-rounded btn-inline btn-success" id="masuk">Masuk</button>
	                        </form>
	                                </td>
	                                <td>
	                            <button type="button" class="btn btn-rounded btn-inline btn-warning" data-toggle="modal" data-target="#{{$row->id}}">Izin Tidak Masuk</button>
	                        <!--  -->
	                        <div class="modal fade" id="{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Alasan Tisak Masuk</h4>
                                        </div>
                                        <div class="modal-body">
                                           <form method="POST"  action="{{url('/tamabsen')}}">
                                            <div class="form-group">
	                        		<input type="hidden" name="id_karyawan" id="id_karyawan" value="{{$row->id}}">
	                        		<input type="hidden" name="id_jabatan" id="id_jabatan" value="{{$row->id_jabatan}}">
	                        		<input type="hidden" name="tanggal" id="tanggal" value="{{$tanggal}}">
                                               <input type="text" name="ketizin" class="form-control" placeholder="Masukan Alasan" required>
                                            </div>
                                           {{csrf_field()}}
                                            <button type="submit" class="btn btn-info">Simpan</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            
                                            </form>
                                        </div>
                                 
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
	                        		</td>
	                                <td>
	                            <form method="POST" action="{{url('/tamabsen')}}" role="form" class="form-horizontal form-bordered" id="forminput">
	                        		<input type="hidden" name="id_karyawan" id="id_karyawan" value="{{$row->id}}">
	                        		<input type="hidden" name="id_jabatan" id="id_jabatan" value="{{$row->id_jabatan}}">
	                        		<input type="hidden" name="tanggal" id="tanggal" value="{{$tanggal}}">
	                        		<input type="hidden" name="ma_tima" id="tahun" value="tidak_masuk">
	                        		{{csrf_field()}}
	                              <button type="submit" class="btn btn-rounded btn-inline btn-danger" id="tidak_masuk">Tidak Masuk</button>
	                        </form>
	                          		</td>
	                                	@endif
	                            </tr>
						@endforeach
						</tbody>
					</table>
					 {{ $karyawan->links() }}
<small class="text-muted text-right">
								
<!-- <input class="btn btn-primary" type="submit" name="submit" onclick="return confirm('Tampilkan Tampil Data Absensi Bulanan ?')" value="Lanjut"> -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#selesai">Selesai</button>
<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
</small>
<div class="modal fade" id="selesai" tabindex="5" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">Penting</h4>
</div>
<div class="modal-body">
<form method="POST"  action="{{url('/tamabsensel')}}">
<div class="form-group">
dengan menekan tombol selesai Karyawan yg belum absen hari ini akan dinyatakan tidak masuk.<br>
Apakah anda yakin ingin melanjutkanya?
</div>
{{csrf_field()}}
<hr>
<button type="submit" class="btn btn-info">Lanjutkan</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
</form>
</div>
</div>
</div>
</div>
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
	</script>
	@endsection