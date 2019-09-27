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
                                <h2>Rekap Surat Jalan {{' Tanggal - '.$bul1.' - '.$bul2 }}</h2>
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
                                <th>No Resi</th>
                                <th>Tanggal</th>
                                <th>Admin</th>
                                <th>Vendor</th>
                                <th>Tujuan</th>
                                <th>Biaya</th>
                            </tr>
                            </thead>                            
                            <tbody>
                            <?php $nomer = 1;?>
                                @foreach($data as $row)
                            <tr>
                                <td>{{$nomer++}}</td>
                                <td>{{$row->kode}}</td>                                
                                <td>{{$row->tgl}}</td>    
                                <td>{{$row->admin}}</td>                           
                                <td>
                                    {{$row->tujuan}}
                                </td>
                                <td>{{$row->alamat_tujuan}}</td>
                                <td>Rp. {{number_format($row->biaya)}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" align="right"><b>Total</b></td>
                                <td ><b>Rp. {{number_format($total->tbiaya)}}</b></td>
                            </tr>
                            </tbody>
                        </table>        
                        <br>    
                        <div class="row">                       
                            <div class="col col-xl-12 dashborad-col">
                                <button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right mr-2">Kembali</button>
                                @php
                                    $k=str_replace(' ','_',$kate);
                                @endphp
                                <a href="{{url('print-srj').'/'.$k.'/'.$bul1.'/'.$bul2}}" class="btn mr-2 btn-primary pull-right">Print</a>
                            </div>
                        </div>            
                        
                    </div>
                </section>

        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>
@endsection