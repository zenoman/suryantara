@extends('layout.masteradminnew')
@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/separate/pages/others.min.css')}}">
    <link rel="stylesheet" href="{{asset('datpick/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/separate/vendor/select2.min.css')}}">
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">                              
            <div class="row">
                @if (Session::get('cabang')=='1')                                    
                <div class="col-sm-6 col-md-4 col-xl-3">
                        <div class="card">
                            <div class="add-customers-screen tbl">
                                <div class="add-customers-screen-in">
                                    <div class="add-customers-screen-user">
                                        <i class="fa fa-gg"></i>
                                    </div>
                                    <p>Rekap Pajak</p>
                                    <form action="{{url('rekap-pajak')}}" method="GET" class="form">
                                        {{csrf_field()}}
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
                                    </form>                                                                            
                                </div>
                            </div>
                        </div>
                </div>
                @endif
                <div class="col-sm-6 col-md-4 col-xl-3">
                        <div class="card">
                            <div class="add-customers-screen tbl">
                                <div class="add-customers-screen-in">
                                    <div class="add-customers-screen-user">
                                        <i class="fa fa-bar-chart"></i>
                                    </div>
                                    <p>Rekap Pengeluaran Rutin</p>     
                                    <form action="{{url('rekap-pengeluaran')}}" method="GET" class="form">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="">Dari</label>
                                            <input type="text" name="tgl1" required readonly class="date form-control mr-sm-2" placeholder="Tanggal Pertama"> 
                                        </div>
                                        <div class="form-group">
                                            <label for="">Ke</label>
                                            <input type="text" name="tgl2" required readonly class="date form-control mr-sm-2" placeholder="Tanggal Kedua"> 
                                        </div>
                                        <div class="form-group">
                                            <label for="">Pilihan Rekap</label>
                                            <select required name="kat" id="" class="select2">
                                                <option selected disabled hidden> Pilih Rekap</option>
                                                <option value="semua">Semua Rekap</option>
                                                @foreach ($kat as $item)
                                                <option value="{{$item->kode}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <Button type="submit" class="btn btn-sm btn-block">Tampilkan</Button>
                                        </div>
                                    </form>     
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="card">
                        <div class="add-customers-screen tbl">
                            <div class="add-customers-screen-in">
                                <div class="add-customers-screen-user">
                                    <i class="fa fa-line-chart"></i>
                                </div>
                                <p>Rekap Pemasukan Resi</p>                                
                                <form action="{{url('rekap-resi')}}" method="GET" class="form">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="">Dari</label>
                                        <input type="text" name="tgl1"  readonly class="date form-control mr-sm-2" placeholder="Tanggal Pertama"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="">Ke</label>
                                        <input type="text" name="tgl2"  readonly class="date form-control mr-sm-2" placeholder="Tanggal Kedua"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="">Pilihan Rekap</label>
                                        <select name="kat" id="" class="select2">
                                            <option selected disabled hidden> Pilih Rekap</option>
                                            <option value="semua">Lunas  & Belum </option>
                                            <option value="lunas">Resi Lunas</option>
                                            <option value="belum">Resi Belum</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <Button type="submit" class="btn btn-sm btn-block">Tampilkan</Button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="card">
                        <div class="add-customers-screen tbl">
                            <div class="add-customers-screen-in">
                                <div class="add-customers-screen-user">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <p>Rekap Gaji Karyawan</p>     
                                <form action="{{url('rekap-gaji')}}" method="GET" class="form">
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
                                            <input type="number" name="th" class="form-control" value="{{date('Y')}}">
                                        </div>
                                        <div class="form-group">
                                            <Button class="btn btn-primary btn-sm btn-block">Tampilkan</Button>
                                        </div>
                                    </form>                                                                                   
                            </div>
                        </div>
                    </div>
                </div>
                @if (Session::get('cabang')=='1')                                    
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="card">
                        <div class="add-customers-screen tbl">
                            <div class="add-customers-screen-in">
                                <div class="add-customers-screen-user">
                                    <i class="fa fa-car"></i>
                                </div>
                                <p>Rekap Pajak Kendaraan</p>
                                <form action="{{url('rekap-kendaraan')}}" method="GET" class="form">
                                    {{csrf_field()}}
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
                                </form>                                                                                                                       
                            </div>
                        </div>
                    </div>
                </div>
                @endif                
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="card">
                        <div class="add-customers-screen tbl">
                            <div class="add-customers-screen-in">
                                <div class="add-customers-screen-user">
                                    <i class="fa fa-paper-plane"></i>
                                </div>
                                <p>Rekap Transfer</p>    
                                <form action="{{url('rekap-transfer')}}" method="GET" class="form">
                                    {{csrf_field()}}
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
                                </form>                                                                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="card">
                        <div class="add-customers-screen tbl">
                            <div class="add-customers-screen-in">
                                <div class="add-customers-screen-user">
                                    <i class="fa fa-circle-o-notch"></i>
                                </div>
                                <p>Rekap Surat Jalan</p>
                                <form action="{{url('rekap-suratjalan')}}" method="GET" class="form">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="">Dari</label>
                                        <input type="text" name="tgl1" required readonly class="date form-control mr-sm-2" placeholder="Tanggal Pertama"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="">Ke</label>
                                        <input type="text" name="tgl2" required readonly class="date form-control mr-sm-2" placeholder="Tanggal Kedua"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="">Pilihan Vendor</label>
                                        <select required name="kat" id="" class="select2">
                                            <option selected disabled hidden> List Vendor</option>
                                            <option value="semua">Semua Vendor</option>
                                            @foreach ($vn as $item)
                                            <option value="{{$item->vendor.'-'.$item->telp}}">{{$item->vendor}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <Button type="submit" class="btn btn-sm btn-block">Tampilkan</Button>
                                    </div>
                                </form>   
                            </div>
                        </div>
                    </div>
                </div>
                @if (Session::get('cabang')=='1')                                    
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="card">
                        <div class="add-customers-screen tbl">
                            <div class="add-customers-screen-in">
                                <div class="add-customers-screen-user">
                                    <i class="fa fa-balance-scale"></i>
                                </div>
                                <p>Neraca</p>  
                                <form action="{{url('rekap-neraca')}}" method="GET" class="form">
                                        {{csrf_field()}}
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
                                    </form>                                                                           
                            </div>
                        </div>
                    </div>
                </div>                               
                <div class="col-sm-6 col-md-4 col-xl-3">
                        <div class="card">
                            <div class="add-customers-screen tbl">
                                <div class="add-customers-screen-in">
                                    <div class="add-customers-screen-user">
                                        <i class="fa fa-compress"></i>
                                    </div>
                                    <p>Penyusutan Aset</p>  
                                    <form action="{{url('rekap-penyusutan')}}" method="GET" class="form">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="">Pilih Aset</label>
                                                <select name="aset" class="select2" id="">
                                                    <option disabled hidden selected>Pilih</option>                                                    
                                                    <option value="semua">Pilih Semua</option>                                                    
                                                    @foreach ($aset as $as)
                                                        <option value="{{$as->id}}">{{$as->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>                                                                                       
                                            <div class="form-group">
                                                <Button type="submit" class="btn btn-primary btn-sm btn-block">Tampilkan</Button>
                                            </div>
                                        </form>                                                                           
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif 
        </div>
    </div>    
@endsection
@section('js')
    <script src="{{asset('assets/js/lib/moment/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('datpick/js/bootstrap-datepicker.min.js')}}"></script> 
    <script src="{{asset('assets/js/lib/select2/select2.full.min.js')}}"></script>       
    <script>
    $('.date').datepicker({
        format: 'yyyy-mm-dd',
    });
    // modal showpajak

    </script>

@endsection