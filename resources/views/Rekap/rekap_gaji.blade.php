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
                                <h2>Rekap Gaji Karyawan {{'Bulan - '.$bul1.' - '.$bul2.' Tahun - '.$th}}</h2>
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
                                <th>Karyawan</th>                                
                                <th>Gaji Pokok</th>
                                <th>Uang Makan</th>
                                <th>Bonus</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Total</th>
                            </tr>
                            </thead>                            
                            <tbody>
                            <?php $nomer = 1;?>
                                @foreach($lap as $row)
                            <tr>
                                <td>{{$nomer++}}</td>
                                <td>{{$row->nama_karyawan}}</td>                                
                                <td>Rp. {{number_format($row->gaji_pokok)}}</td>   
                                @if ($row->uang_makan==null)
                                <td>-</td>
                                @else
                                <td>Rp. {{number_format($row->uang_makan)}}</td>    
                                @endif                        
                                @if ($row->gaji_tambahan==null)
                                <td>-</td>
                                @else
                                <td>Rp. {{number_format($row->gaji_tambahan)}}</td>    
                                @endif    
                                <td>{{$row->bulan}}</td>
                                <td>{{$row->tahun}}</td>
                                <td>Rp. {{number_format($row->total)}}</td>
                                <td class="tdtot">{{$row->total}}</td>
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
                        <button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</button>
                        <a href="{{url('cetak-gaji').'/'.$bul1.'/'.$bul2.'/'.$th}}" class="btn btn-primary pull-right">Print</a>
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
                sumval=sumval+parseInt(table.rows[i].cells[8].innerHTML);
            }
            $('#toata').html(numberWithCommas(sumval));
    </script>
@endsection