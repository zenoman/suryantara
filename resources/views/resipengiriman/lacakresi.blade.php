@extends('layout.masteradminnew')
@section('header')
@foreach($webinfo as $info)
<title>{{$info->namaweb}}</title>
<link href="{{asset('img/setting/'.$info->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection


@section('content')
<div class="page-content">
		<div class="container-fluid">
			<section class="box-typical">
				<header class="box-typical-header">
					<div class="tbl-row">
						<div class="tbl-cell tbl-cell-action-bordered">
							<button onclick="history.go(-1)" type="button" class="action-btn btn-danger">
								<i class="font-icon font-icon-arrow-left"></i>
							</button>
						</div>
						<div class="tbl-cell tbl-cell-title">
							<h3>Hasil Tracking Resi "<b>{{$resi}}</b>"</h3>
						</div>
						
					</div>
				</header>
				<div class="box-typical-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="text-center">Tanggal</th>
									<th class="text-center">Jam</th>
									<th class="text-center">Status</th>
									<th class="text-center">Keterangan</th>
									<th class="text-center">Lokasi</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $row)
								<tr>
									<td class="text-center">
										{{$row->tgl}}
									</td>
									<td class="text-center">
										{{$row->jam}}
									</td>
									<td class="color-blue-grey-lighter text-center">
										{{$row->status}}
									</td>
									<td class="table-icon-cell text-center">
										@if($row->keterangan!='')
										{{$row->keterangan}}
										@else
										-
										@endif
									</td>
									<td class="table-icon-cell text-center">
										{{$row->lokasi}}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div><!--.box-typical-body-->
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
@endsection