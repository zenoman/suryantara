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
                                <h2>Laporan Pengeluaran {{'Bulan - '.$bul1.' - '.$bul2 }}</h2>
                            </div>
                        </div>
                    </div>
                </header>
                <section class="card">
                    <div class="card-block">                       
                        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Admin</th>                                
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Cabang</th>
                                <th>Total</th>
                            </tr>
                            </thead>                            
                            <tbody>
                            <?php $nomer = 1;?>
                                @foreach($lap as $row)
                            <tr>
                                <td>{{$nomer++}}</td>
                                <td>{{$row->admin}}</td>                                
                                <td>{{$row->tgl}}</td>    
                                <td>{{$row->kategori}}</td>                           
                                <td>
                                    {{$row->keterangan}}
                                </td>
                                <td>{{$row->nama}}</td>
                                <td>Rp. {{number_format($row->jumlah)}}</td>
                                <td class="tdtot">{{$row->jumlah}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>        
                        <br>
                        <div class="row">
                        <div class="col col-xl-12 dashboard-col">
                            <h4 class="pull-right"><b>Total Rp. <span id="toata"></span></b></h4>
                        </div>                        
                        <br>              
                        <div class="col col-xl-12 dashboard-col">           
                        <button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right">
                            Kembali
                        </button>
                        <a href="{{url('cetak-pengeluaran').'/'.$kate.'/'.$bul1.'/'.$bul2.'/'.$kat}}" class="btn btn-primary pull-right">Print</a>
                        </div>
                        </div>
                    </div>
                </section>

        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.tdtot').hide();
    });
    // Call Sum
		function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}

		var table=document.getElementById('example'),sumval=0;
		for(var i=1;i<table.rows.length;i++){
			// sumval=sumval+parseInt(table.rows[i].cells[5].innerHTML);
			sumval=sumval+parseInt(table.rows[i].cells[7].innerHTML);
		}
		$('#toata').html(numberWithCommas(sumval));
</script>
@endsection