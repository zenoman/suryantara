@extends('layout.masteradminnew')
@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="section-header">
                <h5>Setting Besaran Pajak Dan Saldo Akhir </h5>                
            </div>
            @if (Session('msg'))
            <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   {{Session('msg')}}
            </div>
            @endif           
            <div class="row">                 
                <div class="col-xl-6 dashboard-column">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Data Setting Pajak
                                <button data-toggle="modal" data-target="#modalpajak" id="addpajak" class="btn btn-primary btn-sm pull-right">Tambah Data</button>
                            </div>                            
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pajak</th>
                                        <th>Persentase</th>
                                        <th>Tempo</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $no=1 ?>
                                    @foreach ($pj as $p)                                   
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$p->pajak}}</td>
                                            <td>{{$p->besaran}}%</td>
                                            <td>{{$p->tempo}}</td>
                                            <td>
                                                <button data-toggle="modal" data-target="#edm{{$p->id}}" class="btn btn-primary btn-sm"><span class="font-icon font-icon-pencil"></span></button>
                                                <a href="{{url('hapus-pajak').'/'.$p->id}}" class="btn btn-danger btn-sm"><span class="font-icon font-icon-trash"></span></a>
                                            </td>
                                        </tr>
                                        {{-- Modal Edit --}}
                                        <div class="modal fade in" role="dialog" id="edm{{$p->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class="modal-title">Edit Pajak</div>
                                                        </div>
                                                        <form action="{{url('update-setpajak')}}" method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="">Nama Pajak</label>
                                                                    <input type="hidden" name="idp" value="{{$p->id}}">
                                                                    <input type="text" value="{{$p->pajak}}" required placeholder="Jenis Pajak" name="pajak" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Besaran Pajak (dalam %)</label>
                                                                    <input type="number" value="{{$p->besaran}}" required name="besar" placeholder="contoh 10" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Tempo Pajak</label>
                                                                    <select name="tempo" id="" class="form-control">
                                                                        <option value="{{$p->tempo}}">{{$p->tempo}}</option>
                                                                        <option value="tahun">Tahun</option>
                                                                        <option value="bulan">Bulan</option>
                                                                        <option value="minggu">Minggu</option>
                                                                        <option value="hari">Harian</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <Button class="btn btn-primary btn-sm pull-right" type="submit">Simpan</Button>
                                                                <Button class="btn btn-danger btn-sm pull-right" data-dismiss="modal">Tutup</Button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>                    
                </div>
                <div class="col-xl-6 dashboard-column">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    Data Setting Saldo Sisa cabang
                                    <button  id="addsaldo" data-toggle="modal" data-target="#modalsaldo"  class="btn btn-primary btn-sm pull-right">Tambah Data</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Cabang</th>
                                            <th>Besar Saldo</th>                                            
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; ?>
                                        @foreach ($sal as $sl)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$sl->nama}}</td>
                                                <td>Rp. {{number_format($sl->saldo)}}</td>
                                                <td>
                                                    <button data-target="#ms{{$sl->id}}" data-toggle="modal" class="btn btn-primary btn-sm"><span class="font-icon font-icon-pencil"></span></button>
                                                    <a href="{{url('del-saldo').'/'.$sl->id}}" class="btn btn-danger btn-sm"><span class="font-icon font-icon-trash"></span></a>
                                                </td>
                                            </tr>
                                            <div class="modal fade in" role="dialog" id="ms{{$sl->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <div class="modal-title">Tambah Saldo</div>
                                                            </div>
                                                            <form action="{{url('update-saldo')}}" method="post">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="">pilih cabang</label>
                                                                        <input type="hidden" name="ids" value="{{$sl->id}}">
                                                                        <select name="cabang" id="" class="form-control">
                                                                            <option value="{{$sl->idc}}">{{$sl->nama}}</option>
                                                                            @foreach ($cb as $item)                                                                                
                                                                                <option value="{{$item->id}}">{{$item->nama}}</option>                                       
                                                                            @endforeach                                
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Besaran Saldo</label>
                                                                        <input type="number" value="{{$sl->saldo}}" required name="saldo" placeholder="contoh 1.000,000" class="form-control">
                                                                    </div>                        
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <Button class="btn btn-primary btn-sm pull-right" type="submit">Simpan</Button>
                                                                    <Button class="btn btn-danger btn-sm pull-right" data-dismiss="modal">Tutup</Button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>                    
                    </div>
            </div>
        </div>
    </div>
    {{--  modal add pajajk --}}
    <div class="modal fade in" role="dialog" id="modalpajak">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Tambah Pajak</div>
                </div>
                <form action="{{url('simpan-setpajak')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Pajak</label>
                            <input type="text" required placeholder="Jenis Pajak" name="pajak" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Besaran Pajak (dalam %)</label>
                            <input type="number" required name="besar" placeholder="contoh 10" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tempo Pajak</label>
                            <select name="tempo" id="" class="form-control">
                                <option value="tahun">Tahun</option>
                                <option value="bulan">Bulan</option>
                                <option value="minggu">Minggu</option>
                                <option value="hari">Harian</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <Button class="btn btn-primary btn-sm pull-right" type="submit">Simpan</Button>
                        <Button class="btn btn-danger btn-sm pull-right" data-dismiss="modal">Tutup</Button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade in" role="dialog" id="modalsaldo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Tambah Saldo</div>
                </div>
                <form action="{{url('simpan-saldo')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">pilih cabang</label>
                            <select name="cabang" id="" class="form-control">
                                @foreach ($cb as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>                                       
                                @endforeach                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Besaran Saldo</label>
                            <input type="number" required name="saldo" placeholder="contoh 1.000,000" class="form-control">
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <Button class="btn btn-primary btn-sm pull-right" type="submit">Simpan</Button>
                        <Button class="btn btn-danger btn-sm pull-right" data-dismiss="modal">Tutup</Button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  modal add Saldo sisa --}}
    
@endsection