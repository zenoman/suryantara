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
							<h2>Neraca</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="row">
	            <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title"><b>Debit</b></h3>
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
	                            @foreach($data as $row)
	                            <?php $no = $i++;?>
	                            <tr>
	                                <td>
	                                    {{$no}}
	                                </td>
	                                <td>{{$row->kategori}}</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">{{$row->bulan}}-{{$row->tahun}}</span></td>
	                                <td align="center">{{"Rp ".number_format($row->total,0,',','.')}}</td>
	                            </tr>
	                           @endforeach
	                        </table>
	                    </div><!--.box-typical-body-->
	                        
	                            	@foreach($hitd as $row)
	                        <table class="tbl-typical">
	                            <tr>
	                                <td style="text-align: left;"><b><h3>Total</h3></b></font></td>
	                                <td style="text-align: right;"><b>{{"Rp ".number_format($row->tot,0,',','.')}}</b></td>
	                            </tr>
	                        </table>
	                           @endforeach
	                </section><!--.box-typical-dashboard-->
	            </div><!--.col-->
	            <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title"><b>Kredit</b></h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                        <table class="tbl-typical">
	                            <tr>
	                                <th><div>No.</div></th>
	                                <th align="center"><div>Nama</div></th>
	                                <th><div>Tanggal</div></th>
	                                <th align="center"><div>Jumlah</div></th>
	                            </tr>
	                            @foreach($modal as $row)
	                            <tr>
	                                <td>
	                                    1
	                                </td>
	                                <td>{{$row->kategori}}</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">{{$row->bulan}}-{{$row->tahun}}</span></td>
	                                <td align="center">{{"Rp ".number_format($row->total,0,',','.')}}</td>
	                            </tr>
	                            @endforeach
	                            @foreach($data0 as $row)
	                            @foreach($modal as $ro)
	                            <tr>
	                                <td>
	                                    2
	                                </td>
	                                <td>{{$row->kategori}}</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">{{$row->bulan}}-{{$row->tahun}}</span></td>
	                                <td align="center">{{"Rp ".number_format($row->total - $ro->total,0,',','.')}}</td>
	                            </tr>
	                            @endforeach
	                            @endforeach
	                        </table>
	                    </div><!--.box-typical-body-->
	                            @foreach($data0 as $row)
	                    <table class="tbl-typical">
	                            <tr>
	                                <td style="text-align: left;"><b><h3>Total</h3></b></font></td>
	                                <td style="text-align: right;"><b>{{"Rp ".number_format($row->total,0,',','.')}}</b></td>
	                            </tr>
	                    </table>
	                            @endforeach
	                </section><!--.box-typical-dashboard-->
	            </div><!--.col-->
	            <div class="col-xl-12 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    
	                            @foreach($tot as $row)
	                        <table class="tbl-typical">
	                            <tr>
	                                <td style="text-align: left;"><b><h3>Total</h3></b></font></td>
	                                <td style="text-align: right;"><b>{{"Rp ".number_format($row->tot,0,',','.')}}</b></td>
	                            </tr>
	                        </table>
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
