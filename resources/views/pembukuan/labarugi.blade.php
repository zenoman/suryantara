@extends('layout.masteradminnew')
@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/select2.min.css')}}">
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h3>Laporan Laba Rugi</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-9 dashboard-col">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <th>No</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Keterangan</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Admin</th>
                                    <th>Cabang</th>
                                </thead>
                                <tbody>
                                    @php
                                        $no=1;
                                    @endphp
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$item->bulan}}</td>
                                            <td>{{$item->tahun}}</td>
                                            <td>{{$item->keterangan}}</td>
                                            <td>Rp.{{number_format($item->debit,0,',','.')}}</td>
                                            <td>Rp.{{number_format($item->kredit,0,',','.')}}</td>
                                            <td>{{$item->admin}}</td>
                                            <td>{{$item->nama}}</td>
                                        </tr>                                       
                                    @endforeach
                                    <tr>
                                        <td colspan="4" align="right"><b>Total</b></td>
                                        <td>Rp.{{number_format($tot->tdebit,0,',','.')}}</td>
                                        <td>Rp.{{number_format($tot->tkredit,0,',','.')}}</td>
                                        <td align="center"><b>Bersih</b></td>
                                        <td align="center">Rp.<b>{{number_format($tot->tdebit-$tot->tkredit,0,',','.')}}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 dashboard-col">
                    <div class="card">
                        <div class="card-header">Pilih Bulan</div>
                        <div class="card-body">
                            <form action="{{url('search-laba')}}" method="get">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="">Dari</label>
                                    <select name="b1" class="select2" id="">
                                        <option disabled hidden selected>Pilih</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Ke</label>
                                    <select name="b2" class="select2" id="">
                                        <option disabled hidden selected>Pilih</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Tahun</label>
                                    <input type="number" required name="th" class="form-control" value="{{date('Y')}}">
                                </div>
                                <div class="form-group">
                                    <Button type="submit" class="btn btn-primary btn-sm btn-block">Tampilkan</Button>
                                </div>
                                <div class="form-group">
                                    <a href="{{url('cetak-labarugi').'/'.$bul1.'/'.$bul2.'/'.$th}}" class="btn btn-info-outline btn-sm btn-block">Cetak Laporan</a>
                                </div>
                                <div class="form-group">
                                    <button type="button" onclick="window.history.go(-1);" class="btn btn-danger-outline btn-sm btn-block pull-right  ">Kembali</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('assets/js/lib/select2/select2.full.min.js')}}"></script> 
@endsection