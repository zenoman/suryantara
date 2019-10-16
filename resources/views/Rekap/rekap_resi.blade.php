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
                        <table id="example" class="display table-responsive table table-striped table-bordered" cellspacing="0" width="100%">
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
                                <th>Kurang</th>
                                <th>Cabang</th>
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
                                <td>Rp. {{number_format($row->total_biaya-$row->total_bayar)}}</td>
                                <td>{{$row->nama}}</td>
                               
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="9" align="right"><b>Total</b></td>
                                <td ><b>Rp. {{number_format($tbiaya)}}</b></td>
                                <td ><b>Rp. {{number_format($tbayar)}}</b></td>
                                <td ><b>Rp. {{number_format($tkur)}}</b></td>
                                <td ></td>
                            </tr>
                            </tbody>
                        </table>        
                        <br>    
                        <div class="row">                       
                            <div class="col col-xl-12 dashborad-col">
                                <button type="button" onclick="window.history.go(-1);" class="btn btn-danger pull-right mr-2">Kembali</button>
                                <a href="{{url('cetak-resimasuk').'/'.$kate.'/'.$bul1.'/'.$bul2.'/'.$kat}}" class="btn mr-2 btn-primary pull-right">Print</a>
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