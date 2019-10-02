@extends('layout.masteradminnew')
@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('datpick/css/bootstrap-datepicker.min.css')}}">
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            @if (Session::get('msg'))
                <div class="alert alert-primary">
                    <p>{{Session::get('msg')}}</p>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="container-fluid">
                        <Button data-toggle="modal" data-target="#add" class="btn btn-primary btn-sm pull-right">Tambah Data</Button>
                        <div class="modal" id="add">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Tambah Data Aset
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('simpan-aset')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Aset</label>
                                                <input type="text" name="aset" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                <label for="">Tanggal beli</label>
                                                <input type="text" name="tgl_beli" readonly class="date form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Nilai Aset</label>
                                                <input type="text"  name="harga"  class="form-control nominal" >
                                            </div>
                                            <div class="form-group">
                                                <label for="">Nilai Penyusutan</label>
                                                <input type="text" name="susutan" class="form-control  nominal" >
                                            </div>
                                            <div class="form-group">
                                                <label for="">Masa Penyusutan (Dalam Tahun)</label>
                                                <input type="number" name="lamasusut" class="form-control" >
                                            </div>                                                                                    
                                    </div>
                                    <div class="modal-footer">
                                        <Button type="submit" class="btn btn-primary-outline btn-sm pull-right">Simpan</Button>
                                        <Button data-dismiss="modal" class="btn btn-danger-outline btn-sm pull-right">Tutup</Button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="card-block">
                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aset</th>
                                <th>Tanggal Beli</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Nilai Aset</th>
                                <th>Nilai Penyusutan</th>
                                <th>Jangka Penyusutan</th>
                                <th>Besar Penyusutan</th>
                                <th>Expired</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->tgl_beli}}</td>
                                    <td>{{$item->bulan}}</td>
                                    <td>{{$item->tahun}}</td>
                                    <td>Rp. {{number_format($item->nilai)}}</td>
                                    <td>Rp. {{number_format($item->susutan)}}</td>
                                    <td>{{$item->masa_susut}} th</td>
                                    <td>Rp. {{number_format($item->biaya_susut)}}/th</td>
                                    <td>{{$item->tgl_exp}}</td>
                                    <td>
                                        <a href="{{url('hapus-aset').'/'.$item->id}}" class="btn btn-danger-outline btn-sm mr-2"><i class="fa fa-trash"></i></a>
                                        {{-- <button data-toggle="modal" data-target="#a{{$item->id}}" class="btn btn-primary-outline btn-sm"><i class="fa fa-edit"></i></button> --}}
                                    </td>
                                </tr>
                                {{-- MOdal Edit --}}
                                <div class="modal" id="a{{$item->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                Edit Data Aset
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('update-aset')}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="">Aset</label>
                                                        <input type="hidden" name="id" value="{{$item->id}}">
                                                        <input type="text" name="aset" class="form-control" value="{{$item->nama}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Tanggal beli</label>
                                                        <input type="text" readonly name="tgl_beli" class="date form-control" value="{{$item->tgl_beli}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Nilai Aset</label>
                                                        <input type="text" name="harga" class="form-control nominal" value="{{$item->nilai}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Nilai Penyusutan</label>
                                                        <input type="text" name="susutan"  class="form-control nominal" value="{{$item->susutan}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Masa Penyusutan (Dalam Tahun)</label>
                                                        <input type="text" name="lamasusut"  class="form-control" value="{{$item->masa_susut}}">
                                                    </div>                                                    
                                            </div>
                                            <div class="modal-footer">
                                                <Button type="submit" class="btn btn-primary-outline mr-2 btn-sm pull-right">Simpan</Button>
                                                <Button data-dismiss="modal" class="btn btn-danger-outline mr-2 btn-sm pull-right">Tutup</button>
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
@endsection
@section('js')
<script src="{{asset('assets/js/lib/moment/moment-with-locales.min.js')}}"></script>
<script src="{{asset('datpick/js/bootstrap-datepicker.min.js')}}"></script> 
<script>
    $('.date').datepicker({
        format: 'yyyy-mm-dd',
    });
    $('.nominal').on('keyup', function(){
        var n = parseInt($(this).val().replace(/\D/g,''),10);
        $(this).val(n.toLocaleString());
        }); 
</script>
@endsection