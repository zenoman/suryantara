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
							<h2>Laba Rugi {{$ttg}}</h2>
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
	                            @foreach($dapat as $ro)
	                            <?php $no = $i++;?>
	                            <tr>
	                                <td>
	                                    {{$no}}
	                                </td>
	                                <td>{{$ro->nama}}</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">{{$ro->tgl_lunas}}</span></td>
	                                <td align="center">{{"Rp ".number_format($ro->total_biaya,0,',','.')}}</td>
	                            </tr>
	                           @endforeach
	                        </table>
	                    </div><!--.box-typical-body-->
	                        
	                            	
	                            	@foreach($totdapat as $roa)
	                        <table class="tbl-typical">
	                            <tr>
	                                <td style="text-align: left;"><b><h3>Total</h3></b></font></td>
	                                <td style="text-align: right;"><b>{{"Rp ".number_format($roa->toto,0,',','.')}}</b></td>
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

	                            @if($kat == 'semua')
	                            <?php $i = 1;?>

	                            @foreach($data as $row)
	                            <?php $no = $i++;?>
	                            <tr>
	                                <td>
	                                	{{$no}}
	                                </td>
	                                <td>{{$row->nama}}</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">{{$row->tgl}}</span></td>
	                                <td align="center">{{"Rp ".number_format($row->jumlah,0,',','.')}}</td>
	                            </tr>
	                            @endforeach

	                            <?php $i = 1;?>

	                            @foreach($kluar as $row)
	                            <?php $no = $i++;?>
	                            <tr>
	                                <td>
	                                	{{$no}}
	                                </td>
	                                <td>{{$row->nama}}</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">{{$row->tgl}}</span></td>
	                                <td align="center">{{"Rp ".number_format($row->totalcash,0,',','.')}}</td>
	                            </tr>
	                            @endforeach

	                            <?php $i = 1;?>

	                            @foreach($pjk as $row)
	                            <?php $no = $i++;?>
	                            <tr>
	                                <td>
	                                	{{$no}}
	                                </td>
	                                <td>{{$row->nama}}</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">{{$row->bulan}}-{{$row->tahun}}</span></td>
	                                <td align="center">{{"Rp ".number_format($row->total,0,',','.')}}</td>
	                            </tr>
	                            @endforeach

	                            @elseif($kate == 'pjk')
	                            <?php $i = 1;?>

	                            @foreach($pjk as $row)
	                            <?php $no = $i++;?>
	                            <tr>
	                                <td>
	                                	{{$no}}
	                                </td>
	                                <td>{{$row->nama}}</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">{{$row->bulan}}{{$row->tahun}}</span></td>
	                                <td align="center">{{"Rp ".number_format($row->total,0,',','.')}}</td>
	                            </tr>
	                            @endforeach

	                            @elseif($kate == 'surjal')
	                            <?php $i = 1;?>

	                            @foreach($kluar as $row)
	                            <?php $no = $i++;?>
	                            <tr>
	                                <td>
	                                	{{$no}}
	                                </td>
	                                <td>{{$row->nama}}</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">{{$row->tgl}}</span></td>
	                                <td align="center">{{"Rp ".number_format($row->totalcash,0,',','.')}}</td>
	                            </tr>
	                            @endforeach
	                            @else
	                            <?php $i = 1;?>

	                            @foreach($data as $row)
	                            <?php $no = $i++;?>
	                            <tr>
	                                <td>
	                                	{{$no}}
	                                </td>
	                                <td>{{$row->nama}}</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">{{$row->tgl}}</span></td>
	                                <td align="center">{{"Rp ".number_format($row->jumlah,0,',','.')}}</td>
	                            </tr>
	                            @endforeach
	                            @endif
	                        </table>
	                    </div><!--.box-typical-body-->
	                    		@if($kat == 'semua')

	                            @foreach($tot as $ro)
	                            @foreach($totkluar as $row)
	                            @foreach($totpjk as $rox)
	                            <table class="tbl-typical">
	                            <tr>
	                                <td style="text-align: left;"><b><h3>Total</h3></b></font></td>
	                                <td style="text-align: right;"><b>{{"Rp ".number_format($ro->toto + $row->toto + $rox->toto,0,',','.')}}</b></td>
	                            </tr>
	                    </table>
	                            @endforeach
	                            @endforeach
	                            @endforeach

	                            @else

	                            @foreach($tot as $ro)
	                    <table class="tbl-typical">
	                            <tr>
	                                <td style="text-align: left;"><b><h3>Total</h3></b></font></td>
	                                <td style="text-align: right;"><b>{{"Rp ".number_format($ro->toto,0,',','.')}}</b></td>
	                            </tr>
	                    </table>
	                            @endforeach
	                            @endif

	                </section><!--.box-typical-dashboard-->
	            </div><!--.col-->
	            <div class="col-xl-12 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    @if($kat == 'semua')
	                @foreach($totdapat as $roa)
					@foreach($tot as $ro)
					@foreach($totkluar as $row)
	                @foreach($totpjk as $rox)
	                        <table class="tbl-typical">
	                            <tr>
	                                <td style="text-align: left;"><b><h3>Laba Rugi</h3></b></font></td>
<td style="text-align: left;"><b><h3>{{"Rp ".number_format($roa->toto - $ro->toto - $row->toto - $rox->toto,0,',','.')}}</h3></b></td>
	                                <td>
				<div class="pull-right">
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
					@endforeach
					@endforeach

					@elseif($kat == 'pjk')
	                @foreach($totdapat as $roa)
	                @foreach($totpjk as $rox)
	                        <table class="tbl-typical">
	                            <tr>
	                                <td style="text-align: left;"><b><h3>Laba Rugi</h3></b></font></td>
<td style="text-align: left;"><b><h3>{{"Rp ".number_format($roa->toto - $rox->toto,0,',','.')}}</h3></b></td>
	                                <td>
				<div class="pull-right">
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

					@elseif($kat == 'surjal')
	                @foreach($totdapat as $roa)
					@foreach($totkluar as $row)
	                        <table class="tbl-typical">
	                            <tr>
	                                <td style="text-align: left;"><b><h3>Laba Rugi</h3></b></font></td>
<td style="text-align: left;"><b><h3>{{"Rp ".number_format($roa->toto- $row->toto,0,',','.')}}</h3></b></td>
	                                <td>
				<div class="pull-right">
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
	                    @else
	                @foreach($totdapat as $roa)
					@foreach($tot as $ro)
	                        <table class="tbl-typical">
	                            <tr>
	                                <td style="text-align: left;"><b><h3>Laba Rugi</h3></b></font></td>
<td style="text-align: left;"><b><h3>{{"Rp ".number_format($roa->toto  - $ro->toto,0,',','.')}}</h3></b></td>
	                                <td>
				<div class="pull-right">
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
	                    @endif
	                    
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
