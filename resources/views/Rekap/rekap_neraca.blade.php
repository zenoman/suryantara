@extends('layout.masteradminnew')
@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h2>Laporan Neraca {{'Bulan - '.$bul1.' - '.$bul2.' Tahun - '.$th}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <section class="card">
                <div class="card-block">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Admin</th>
                                <th>Cabang</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Keterangan</th>
                                <th>Debit</th>
                                <th>Kredit</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach ($lap as $item)
                                <tr>
                                    <td>{{$no++}}</td>                                   
                                    <td>{{$item->admin}}</td>                                    
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->bulan}}</td>
                                    <td>{{$item->tahun}}</td>
                                    <td>{{$item->keterangan}}</td>
                                    <td>Rp. {{number_format($item->debit)}}</td>
                                    <td>Rp. {{number_format($item->kredit)}}</td>
                                </tr>                               
                            @endforeach
                            <tr>
                                <td colspan="6" align="right"> <b>Total</b></td>
                                <td><b>Rp {{number_format($total->totdeb)}}</b></td>
                                <td><b>Rp {{number_format($total->totkred)}}</b></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="row">                                                  
                        <div class="col col-xl-12 dashboard-col">           
                        <button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right mr-2">
                            Kembali
                        </button>
                        <a href="{{url('cetak-neraca').'/'.$bul1.'/'.$bul2.'/'.$th}}" class="btn btn-primary pull-right mr-2">Print</a>
                        </div>
                        </div>
                </div>
            </section>
        </div>
    </div>
@endsection