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
							<h2>Data Resi manual</h2>
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

					<a href="{{url('Manual/create')}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Tambah Data</a>
					<a href="{{url('Manual/importexcel')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Import Excel</a>
                               
                    <br><br>
                    <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Resi</th>
                            <th>Resi/SMU</th>
                            <th>Tanggal</th>
                            <th>Jalur</th>
                            <th>Tujuan</th>
							<th>Pemegang</th>
							<th class="text-center">Status</th>
							<th class="text-center">Aksi</th>
                           
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>No</th>
                            <th>Resi</th>
                            <th>Resi/SMU</th>
                            <th>Tanggal</th>
                            <th>Jalur</th>
                            <th>Tujuan</th>
                            <th>Pemegang</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                             
						</tr>
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($manual as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>
                               @if($row->total_biaya > 0)
                                    @if($row->tgl_lunas !=null)
                                        @if($row->status=='Y')
                                            <button class="btn btn-sm btn-success"
                                            data-toggle="modal"
                                            data-target=".bd-example-modal-lg{{$row->id}}">{{$row->no_resi}}
                                            </button>
                                        @elseif($row->no_smu == null)
                                            <button class="btn btn-sm btn-primary"
                                            data-toggle="modal"
                                            data-target=".bd-example-modal-lg{{$row->id}}">{{$row->no_resi}}
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-primary"
                                            data-toggle="modal"
                                            data-target=".bd-example-modal-lg{{$row->id}}">{{$row->no_resi}}
                                            </button>
                                        @endif

                                    @else
                                        @if($row->status=='Y')
                                            <button class="btn btn-sm btn-success"
                                            data-toggle="modal"
                                            data-target=".bd-example-modal-lg{{$row->id}}"><i class="fa fa-exclamation-triangle"></i> {{$row->no_resi}}
                                            </button>
                                        @elseif($row->no_smu == null)
                                            <button class="btn btn-sm btn-primary"
                                            data-toggle="modal"
                                            data-target=".bd-example-modal-lg{{$row->id}}"><i class="fa fa-exclamation-triangle"></i> {{$row->no_resi}}
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-primary"
                                            data-toggle="modal"
                                            data-target=".bd-example-modal-lg{{$row->id}}"><i class="fa fa-exclamation-triangle"></i> {{$row->no_resi}}
                                            </button>
                                        @endif
                                    @endif
                            
                <div class="modal fade bd-example-modal-lg{{$row->id}}"
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
                                <h4 class="modal-title" id="myModalLabel">Detail Resi</h4>
                            </div>
                            <div class="modal-body">
                    <div class="card-block invoice">
                    <div class="row">
                        <div class="col-lg-6 company-info text-left">
                            
                            <h5 style="margin-bottom: 0.2rem;">Isi paket : {{$row->nama_barang}}</h5>
                            <p>No. Resi/SMU :
                                @if($row->no_smu == null)
                                <b>-</b>
                                @else
                             {{$row->no_smu}}
                                @endif
                            </p>
                            

                            <p>Pengiriman Via : {{$row->pengiriman_via}}</p>

                            <div class="invoice-block">
                                <div>Pengirim : {{$row->nama_pengirim}}</div>
                                <div>No.Telpon : {{$row->telp_pengirim}}</div>
                                <div>Alamat : {{$row->alamat_pengirim}}</div>
                            </div>
                            <br>
                            <div class="invoice-block">
                                <div>Penerima : {{$row->nama_penerima}}</div>
                                <div>No.Telpon : {{$row->telp_penerima}}</div>
                                <div>Alamat : {{$row->alamat_penerima}}</div>
                            </div>
                            <br>
                            <div class="invoice-block">
                            <div>Tanggal : {{$row->tgl}}</div>
                                <div>Tujuan : {{$row->kota_asal}} - {{$row->kode_tujuan}}</div>
                                <div>Metode Bayar : {{$row->metode_bayar}} @if($row->tgl_lunas==null) - <b>Belum Lunas</b> @else - <b>Lunas</b> @endif
                            </div>
                            <div>
                                @if($row->tgl_lunas!=null)
                                Tanggal Pelunasan : {{$row->tgl_lunas}}
                                @else
                                Tanggal Pelunasan : -
                                @endif  
                            </div>
                            </div>
                            <br>
                        </div>
                        <div class="col-lg-6 clearfix invoice-info">
                            <div class="text-lg-right">
                                <h5>{{$row->no_resi}}</h5>
                                
                                <table class="pull-right table-sm">
                                    <tr>
                                        <td>Pemegang</td>
                                        <td>{{$row->nama}}</td>
                                    </tr>
                                    <tr>
                                        <td>Operator</td>
                                        <td>{{$row->admin}}</td>
                                    </tr>
                                    <tr>
                                        <td>Berat Aktual</td>
                                        <td>{{$row->berat}} Kg</td>
                                    </tr>
                                    <tr>
                                        <td>Berat Volumetrik</td>
                                        <td>{{$row->ukuran_volume}} Kg</td>
                                    </tr>
                                    <tr>
                                        <td>Dimensi</td>
                                        <td>{{$row->dimensi}}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah</td>
                                        <td>{{$row->jumlah}} Koli</td>
                                    </tr>
                                </table>
                                <br>
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="row table-details">
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Detail Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        
                                        <td class="text-right">Biaya Kirim</td>
                                        <td class="text-right">Rp. {{number_format($row->biaya_kirim,0,',','.')}}</td>
                                        
                                    </tr>
                                @if($row->pengiriman_via=='udara')
                                    <tr>
                                        <td class="text-right">Biaya SMU</td>
                                        <td class="text-right">Rp. {{number_format($row->biaya_smu,0,',','.')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Biaya Karantina</td>
                                        <td class="text-right">Rp. {{number_format($row->biaya_karantina,0,',','.')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Biaya Charge</td>
                                        <td class="text-right">Rp. {{number_format($row->biaya_charge,0,',','.')}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="text-right">Biaya Packing</td>
                                        <td class="text-right">Rp. {{number_format($row->biaya_packing,0,',','.')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Biaya Asuransi</td>
                                        <td class="text-right">Rp. {{number_format($row->biaya_asuransi,0,',','.')}}</td>
                                    </tr>
                                @endif
                                    <tr>
                                        <td class="text-right">PPN</td>
                                        <td class="text-right">Rp. {{number_format($row->biaya_ppn,0,',','.')}}</td>
                                    </tr>
                                    <tr>
                                        <td><h4>Total</h4></td>
                                        <td class="text-right"><h4>
                                            Rp. {{number_format($row->total_biaya,0,',','.')}}
                                        </h4></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <br>
                        <div class="col-lg-12 terms-and-conditions">
                            <strong>Status : 
                             @if($row->status=='N')
                                Menunggu Pengembalian Resi / Uang
                            @else
                                Pengiriman Sukses
                            @endif
                            </strong>
                            
                        </div>
                        
                    </div>
                        <br>    
                            <div class="row text-left">
                                <form action="tambahsmu" method="post">
                                    <label>Ubah No.Resi/SMU</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" value="" name="nosmu" class="form-control" style="display: block;" required>
                                        <input type="hidden" name="kode" value="{{$row->id}}">
                                        {{csrf_field()}}
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                    </div>
                            </div>
                            <div class="modal-footer">
                                @if($row->metode_bayar=='cash')
                                        @if($row->status=='N')
                                        <a href="{{url('/uangkembali/'.$row->id)}}" class="btn btn-rounded btn-success" onclick="return confirm('Apakah Uang Telah Diterima ?')">Lunas</a>
                                        <a href="{{url('/resikembali/'.$row->id)}}" class="btn btn-rounded btn-primary" onclick="return confirm('Apakah Resi Telah Kembali ?')">Resi Dikembalikan</a>
                                        @elseif($row->status=='US')
                                        <a href="{{url('/resikembali/'.$row->id)}}" class="btn btn-rounded btn-primary" onclick="return confirm('Apakah Resi Telah Kembali ?')">Resi Dikembalikan</a>
                                        @elseif($row->status=='RS')
                                        <a href="{{url('/uangkembali/'.$row->id)}}" class="btn btn-rounded btn-success" onclick="return confirm('Apakah Uang Telah Diterima ?')">Lunas</a>
                                        @endif
                                @else
                                    @if($row->status=='N')
                                    <a href="{{url('/uangkembali/'.$row->id)}}" class="btn btn-rounded btn-success" onclick="return confirm('Apakah Uang Telah Diterima ?')">Uang Dikembalikan</a>
                                    <a href="{{url('/resikembali/'.$row->id)}}" class="btn btn-rounded btn-primary" onclick="return confirm('Apakah Resi Telah Kembali ?')">Resi Dikembalikan</a>
                                    @elseif($row->status=='US')
                                    <a href="{{url('/resikembali/'.$row->id)}}" class="btn btn-rounded btn-primary" onclick="return confirm('Apakah Resi Telah Kembali ?')">Resi Dikembalikan</a>
                                    @elseif($row->status=='RS')
                                    <a href="{{url('/uangkembali/'.$row->id)}}" class="btn btn-rounded btn-success" onclick="return confirm('Apakah Uang Telah Diterima ?')">Uang Dikembalikan</a>
                                    @endif
                                @endif
                                
                                <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                            @else
                                <button class="btn btn-sm btn-danger">         {{$row->no_resi}}
                                </button>
                            @endif
                            </td>
                            <td>
                                @if($row->no_smu=='')
                                @if($row->total_biaya != 0)
                                <span class="label label-danger">
                                kosong
                                </span>
                                @endif
                                @else
                                {{$row->no_smu}}
                                @endif
                            </td>
                            <td>{{$row->tgl}}</td>
                            <td>{{$row->pengiriman_via}}</td>
                            <td>
                                @if($row->total_biaya > 0)
                                {{$row->kota_asal}}-{{$row->kode_tujuan}}
                                @endif
                            </td>
                            <td>{{$row->nama}}</td>
                            <td class="text-center">
                            	@if($row->total_biaya > 0)
                                    @if($row->pengiriman_via=='udara')
                                @if($row->no_smu=='')
                                <span class="label label-warning">Menunggu</span>
                                @else
                                @if($row->status=='Y')
                                    <span class="label label-success">
                                        Sukses
                                    </span>
                                @else
                                    <span class="label label-warning">Menunggu</span>
                                @endif
                                @endif
                                
                            @else
                                @if($row->status=='Y')
                                    <span class="label label-success">
                                        Sukses
                                    </span>
                                @else
                                    <span class="label label-warning">Menunggu</span>
                                @endif
                            @endif
                            	@else
                            	<span class="label label-danger">
                            	Belum Diisi
                            	</span>
                            	@endif
                            </td>
                            <td class="text-center">
                    @if($row->total_biaya > 0)
                        @if(Session::get('level')!='admin')
                            <form action="{{ url('/Manual/delete')}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="aid" value="{{$row->id}}">
                                <a href="{{ url('Manual/'.$row->id.'/ubah') }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a href="{{url('/batalpengiriman/'.$row->id)}}" onclick="return confirm('Batalkan Pengiriman ?')" class="btn btn-primary btn-sm">
                                <i class="fa fa-ban"></i>
                                </a> 
                                @if($row->kode_jalan=='')
                                <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm">
                                    <i class="fa fa-remove"></i>
                                </button>
                                @endif
                            </form>
                        @else
                        -
                        @endif
                    @else
                            <form action="{{ url('/Manual/delete')}}" method="post">    <a href="{{ url('Manual/'.$row->id.'/edit') }}" class="btn btn-rimary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                {{csrf_field()}}
                                <input type="hidden" name="aid" value="{{$row->id}}">
                               <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm">
                                    <i class="fa fa-remove"></i>
                                </button>
                    		</form>
                    @endif
                            </td>
                             
						</tr>
						@endforeach
						</tbody>
						
					</table>
					{{csrf_field()}}
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
	</script>
	@endsection