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
                            <h2>Laporan Penyusutan Aset</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-block">
                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aset</th>
                                <th>Tanggal Beli</th>
                                <th>Tahun/Masa</th>
                                <th>Tanggal Exp</th>
                                <th>Nilai Aset</th>
                                <th>Nilai Sesudah Susut</th>
                                <th>Biaya Penyusutan</th>
                                <th>Akumulasi Penyusutan</th>
                                <th>Nilai Buku</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            
                            @foreach ($data as $item)
                                <tr class="bg-warning">
                                    <th>{{$no++}}</th>
                                    <th>{{$item->nama}}</th>
                                    <th>{{$item->tgl_beli}}</th>
                                    <th>{{$item->tahun.'/'.$item->masa_susut}}th</th>
                                    <th>{{$item->tgl_exp}}</th>
                                    <th>Rp. {{number_format($item->nilai)}}</th>
                                    <th>Rp. {{number_format($item->susutan)}}</th>
                                    <th colspan="2"></th>
                                    <th>Rp. {{number_format($item->nilai)}}</th>
                                </tr>
                                   @if ($aset=="semua")
                                    @php
                                        $d=DB::table('hitung_susutan')
                                            ->leftjoin('aset','aset.id','=','hitung_susutan.kode_aset')                
                                            ->select(DB::raw('hitung_susutan.*,aset.*,hitung_susutan.id as hid, aset.id as setid,hitung_susutan.tahun as ths'))
                                            ->where('kode_aset',$item->id)
                                            ->get();                                           
                                    @endphp
                                    @foreach ($d as $da)
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>{{$da->ths}}</td>
                                            <td colspan="3"></td>
                                            <td>Rp. {{number_format($da->b_susut)}}</td>
                                            <td>Rp. {{number_format($da->a_susut)}}</td>
                                            <td>Rp. {{number_format($da->nilai_susut)}}</td>
                                        </tr>                                       
                                    @endforeach
                                   @else    
                                    @php
                                        $d=DB::table('hitung_susutan')
                                            ->leftjoin('aset','aset.id','=','hitung_susutan.kode_aset')                
                                            ->select(DB::raw('hitung_susutan.*,aset.*,hitung_susutan.id as hid, aset.id as setid,hitung_susutan.tahun as ths'))
                                            ->where('kode_aset',$item->id)
                                            ->get();                                            
                                    @endphp
                                    @foreach ($d as $da)
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>{{$da->ths}}</td>
                                        <td colspan="3"></td>
                                        <td>Rp. {{number_format($da->b_susut)}}</td>
                                        <td>Rp. {{number_format($da->a_susut)}}</td>
                                        <td>Rp. {{number_format($da->nilai_susut)}}</td>
                                    </tr>                                    
                                    @endforeach
                                   @endif                                    
                            @endforeach 
                        </tbody>                        
                    </table>
                    <br>
                    <div class="row pull-right">
                        <div class="col-xl-12 dashboard-col">
                            <a href="{{url('print-susut').'/'.$aset}}" class="btn btn-primary-outline mr-2">Print</a>
                            <Button class="btn btn-danger mr-2" onclick="history.go(-1)">Kembali</Button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection