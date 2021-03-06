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
							<h2>Laba Rugi Tahun {{$tgl}}</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="row">
	            <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title"><b>Pemasukan</b></h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                        <table class="tbl-typical">
	                            <tr>
	                                <th><div>No.</div></th>
	                                <th align="center"><div>Nama</div></th>
	                                <th><div>Tanggal</div></th>
	                                <th align="center"><div>Jumlah</div></th>
	                            </tr>
	                            <?php $i = 1;?>
	                            <?php $j = 0;?>
			@foreach($resi as $ro)
	            <?php $no = $i++;?>
	            <?php $n = $j++;?>
			@foreach($totresi[$n] as $roz)
	                            <tr>
	                                <td>
	                                    {{$no}}
	                                </td>
	                                <td>{{$ro->nama}}</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">{{$ro->tgl}}</span></td>
	                                <td align="center">{{"Rp ".number_format($roz->toto,0,',','.')}}</td>
	                            </tr>
	        @endforeach
	        @endforeach
	                        </table>
	                    </div><!--.box-typical-body-->
	                        
	                            	@foreach($totresithn as $ro)
	                        <table class="tbl-typical">
	                            <tr>
	                                <td style="text-align: left;"><b><h3>Total</h3></b></font></td>
	                                <td style="text-align: right;"><b>{{"Rp ".number_format($ro->toto,0,',','.')}}</b></td>
	                            </tr>
	                        </table>
	                           @endforeach
	                </section><!--.box-typical-dashboard-->
	            </div><!--.col-->
	            <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title"><b>Pengeluaran</b></h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                        <table class="tbl-typical">
	                            <tr>
	                                <th><div>No.</div></th>
	                                <th align="center"><div>Nama</div></th>
	                                <th><div>Tanggal</div></th>
	                                <th align="center"><div>Jumlah</div></th>
	                            </tr>
	                <?php $i = 1;?>
	                <?php $k = 0;?>
	            @foreach($data as $row)
	            <?php $no = $i++;?>
	            <?php $o = $k++;?>
	            @foreach($toto[$o] as $roz0)
	                            <tr>
	                                <td>
	                                	{{$no}}
	                                </td>
	                                <td>{{$row->nama}}</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">{{$row->tgl}}</span></td>
	                                <td align="center">{{"Rp ".number_format($roz0->totalnya,0,',','.')}}</td>
	                            </tr>
	                            @endforeach
	                            @endforeach
	            
	                        </table>
	                    </div><!--.box-typical-body-->
	                            @foreach($tot as $ro)
	                    <table class="tbl-typical">
	                            <tr>
	                                <td style="text-align: left;"><b><h3>Total</h3></b></font></td>
	                                <td style="text-align: right;"><b>{{"Rp ".number_format($ro->toto,0,',','.')}}</b></td>
	                            </tr>
	                    </table>
	                            @endforeach
	                </section><!--.box-typical-dashboard-->
	            </div><!--.col-->
	            <div class="col-xl-12 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    
	                @foreach($totresithn as $ros)
					@foreach($tot as $ro)
	                        <table class="tbl-typical">
	                            <tr>
	                                <td style="text-align: left;"><b><h3>Laba Rugi</h3></b></font></td>
	                                <td style="text-align: left;"><b><h3>{{"Rp ".number_format($ros->toto - $ro->toto ,0,',','.')}}</h3></b></td>
	                                <td>
				<div class="pull-right">
					<a href="{{url('/printlabarugi/'.$tgl.'')}}" target="_blank()" class="btn btn-primary">
					<i class="fa fa-print"></i>Cetak Data</a>
							&nbsp;&nbsp;
							<button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right">
								Kembali
							</button>
				</div>
	                                </td>
	                            </tr>
	                        </table>
	                @endforeach
	                @endforeach
	                    
	                </section><!--.box-typical-dashboard-->
	            </div><!--.col-->
	        </div>
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
