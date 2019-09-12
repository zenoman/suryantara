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
                                <h2>Rekap {{' '.$kat.' Bulan - '.$bul1.' - '.$bul2 }}</h2>
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
                                <th>Admin</th>
                                <th>Barang</th>
                                <th>Via</th>
                                <th>Kota Asal</th>
                                <th>Kota Tujuan</th>
                                <th>Tanggal Kirim</th>
                                <th>Pengirim</th>
                                <th>Total Biaya</th>
                                <th>Pembayaran</th>
                            </tr>
                            </thead>                            
                            <tbody>
                            <?php $nomer = 1;?>
                                @foreach($lap as $row)
                            <tr>
                                <td>{{$nomer++}}</td>
                                <td>{{$row->no_resi}}</td>                                
                                <td>{{$row->admin}}</td>    
                                <td>{{$row->nama_barang}}</td>                           
                                <td>
                                    {{$row->pengiriman_via}}
                                </td>
                                <td>{{$row->kota_asal}}</td>
                                <td>{{$row->kode_tujuan}}</td>
                                <td>{{$row->tgl}}</td>
                                <td>{{$row->nama_pengirim}}</td>
                                <td>Rp. {{number_format($row->total_biaya)}}</td>
                                <td>Rp. {{number_format($row->total_bayar)}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>        
                        <br>                
                        <button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right">
                            Kembali
                        </button>
                        <a href="{{url('cetak-resimasuk').'/'.$kate.'/'.$bul1.'/'.$bul2.'/'.$kat}}" class="btn btn-primary pull-right">Print</a>
                    </div>
                </section>

        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>
@endsection