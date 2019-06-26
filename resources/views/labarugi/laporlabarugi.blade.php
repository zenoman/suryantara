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
			<section class="card">
				<header class="card-header card-header-lg">
					Laba Rugi pada Tanggal {{$tgl}}
				</header>
				<div class="card-block invoice">
					Pemasukan
					@foreach($data0 as $ro)
					<div class="row">
						<div class="col-lg-3 company-info">
							<h5>{{$ro->nama}}-({{$ro->tgl}})</h5>
						</div>
						<div class="col-lg-3 clearfix invoice-info">
							<div class="text-lg-right">
								<h5>{{"Rp ".number_format($ro->jumlah,0,',','.')}}</h5>
							</div>
						</div>
					</div>
					@endforeach
					@foreach($tot0 as $ro)
					<div class="row">
						<div class="col-lg-3 company-info">
							<h5>jumlah </h5>
						</div>
						<div class="col-lg-3 clearfix invoice-info">
							<div class="text-lg-right">
								<h5>{{"Rp ".number_format($ro->toto,0,',','.')}}</h5>
							</div>
						</div>
					</div>
					@endforeach
					Pengeluaran
					@foreach($data as $row)
					<div class="row">
						<div class="col-lg-3 company-info">
							<h5>{{$row->nama}}-({{$row->tgl}})</h5>
						</div>
						<div class="col-lg-3 clearfix invoice-info">
							<div class="text-lg-right">
								<h5>{{"Rp ".number_format($row->jumlah,0,',','.')}}</h5>
							</div>
						</div>
					</div>
					@endforeach
<!-- 					<div class="row">
						<div class="col-lg-6">
							<hr>
						</div>
					</div> -->
					@foreach($tot as $ro)
					<div class="row">
						<div class="col-lg-3 company-info">
							<h5>jumlah </h5>
						</div>
						<div class="col-lg-3 clearfix invoice-info">
							<div class="text-lg-right">
								<h5>{{"Rp ".number_format($ro->toto,0,',','.')}}</h5>
							</div>
						</div>
					</div>
					@endforeach
					<!-- <hr> -->
					<div class="row">
						
						<div class="col-lg-5 clearfix">
							<div class="total-amount">
					@foreach($tot0 as $ror)
								<div>Pendapatan: <b>{{"Rp ".number_format($ror->toto,0,',','.')}}</b></div>
					@endforeach
					@foreach($tot as $ro)
								<div>Pengeluaran: <b>{{"Rp ".number_format($ro->toto,0,',','.')}}</b></div>
					@endforeach
					@foreach($tot0 as $ros)
					@foreach($tot as $ro)
								<div>Laba rugi: <span class="colored">{{"Rp ".number_format($ros->toto - $ro->toto,0,',','.')}}</span></div>
					@endforeach
					@endforeach
								<p><br></p>
								<div class="actions">
									<button class="btn btn-rounded btn-inline">Send</button>
									<button class="btn btn-inline btn-secondary btn-rounded">Print</button>
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