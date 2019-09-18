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
                                <h2>Laporan Pajak {{'Bulan - '.$bul1.' - '.$bul2.' Tahun - '.$th}}</h2>
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
                                <th>Bulan</th>                                
                                <th>Tahun</th>
                                <th>Keterangan</th>
                                <th>Total</th>
                            </tr>
                            </thead>                            
                            <tbody>
                            <?php $nomer = 1;?>
                                @foreach($lap as $row)
                            <tr>
                                <td>{{$nomer++}}</td>
                                <td>{{$row->bulan}}</td>                                
                                <td>{{$row->tahun}}</td>                               
                                <td>
                                    {{$row->nama_pajak}}
                                </td>
                                <td>{{number_format($row->total)}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>        
                        <br>                
                        <button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right">
                            Kembali
                        </button>
                    </div>
                </section>

        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>
@endsection