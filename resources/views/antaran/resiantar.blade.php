@extends('layout.masteradminnew')


@section('header')
@foreach($webinfo as $row)
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
							<h2>List Resi Antaran</h2>
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
                    @if (session('statuserror'))
                    <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('statuserror') }}
                    </div>
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
                                           <form method="get" action="{{url('cariresisuratantar')}}">
                                            <div class="form-group">
                                                <input type="text" name="cari" class="form-control" placeholder="cari berdasarkan Resi / no. surat antar / Pemegang / Tanggal" required>
                                            </div>
                                           {{csrf_field()}}
                                            <input type="submit" class="btn btn-info" value="Cari Data">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            
                                            </form>
                                        </div>
                                 
                                    </div>
                                </div>
                            </div> 
                    <br><br>
                   
                    <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Resi</th>
							<th>Pemegang</th>
							<th>No. Surat Antar</th>
							<th>Tanggal</th>
							<th>Status</th>
							
						</tr>
						</thead>
						<tfoot>
							<tr>
								<th>No</th>
							<th>Resi</th>
							<th>Pemegang</th>
							<th>No. Surat Antar</th>
							<th>Tanggal</th>
							<th>Status</th>
							</tr>
							
						</tfoot>
						<tbody>
						<?php $i = 1;?>
                            @foreach($data as $row)
                            <?php $no = $i++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>
                            	@if($row->batal=='N')
                            	{{$row->no_resi}}
                            	@else
                            	<span class="text-danger">
                            		{{$row->no_resi}}
                            	</span>
                            	@endif
                            </td>
                            <td>
                            	{{$row->pemegang}}
                            </td>
                            <td>{{$row->kode_antar}}</td>
                            <td>{{$row->tgl}}</td>
                            <td>
                            	@if($row->status_pengiriman=='menuju alamat tujuan')
                            		<span class="label label-primary">
                            		{{$row->status_pengiriman}}
                            		</span>
                            	@elseif($row->status_pengiriman=='pengantaran ulang')
                            		<span class="label label-warning">
                            		{{$row->status_pengiriman}}
                            		</span>
                            	@elseif($row->status_pengiriman=='dikembalikan ke pengirim')
                            		<span class="label label-danger">
                            			{{$row->status_pengiriman}}
                            		</span>
                            	@else
                            		<span class="label label-success">
                            			{{$row->status_pengiriman}}
                            		</span>
                            	@endif
                            </td>
                        </tr>
						
						@endforeach
						</tbody>
					</table>
					<div class="pull-right">
					
					<a href="{{url('/listantaran')}}" class="btn btn-danger">Kembali</a>
					</div>
					
					 {{ $data->links() }}
				</div>
			</section>
		</div><!--.container-fluid-->
	</div>
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

	</script>
	<script language="javascript">
    $(function(){
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){

        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }

    });
});
</script>
	@endsection