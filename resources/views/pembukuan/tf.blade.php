@extends('layout.masteradminnew')
@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('css')
<link href="{{asset('assets/css/lib/charts-c3js/c3.min.css')}}" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="{{asset('assets/css/lib/lobipanel/lobipanel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/lobipanel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/lib/jqueryui/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/pages/widgets.min.css')}}">
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-header">
                <h4>Transfer Ke Pusat </h4>                
            </div>
            <div class="row">
                <div class="col-xl-8 dashboard-column">
                    <div class="row">
                        <div class="col-xl-6 dahsboard-column">
                            <section class="widget widget-time">
                            <header class="widget-header-dark with-btn">
                                Jumlah Saldo Pendapatan Total                           
                            </header>
                            <div class="widget-time-content">
                                <div class="caption">Total Pemasukan Resi</div>
                                <div class="number"><b>
                                    @foreach ($inresi as $tres)
                                    <div id="ftres">Rp. {{number_format($tres->totalres)}}</div> 
                                    <div id="tres">{{$tres->totalres}}</div>
                                    @endforeach
                                </b>    
                                </div> 
                                <hr>
                                <div class="caption">Total Pemasukan Lain</div>
                                <div class="number"><b>
                                    @foreach ($inpen as $inp)
                                    <div id="ftin">Rp. {{number_format($inp->totalin)}}</div> 
                                    <div id="tin">{{$inp->totalin}}</div>
                                    @endforeach
                                </b>    
                                </div>  
                            </div>
                            </section>
                        </div>
                        <div class="col-xl-6 dahsboard-column">
                            <section class="widget widget-time">
                            <header class="widget-header-dark with-btn">
                                Jumlah Pengeluaran Total                           
                            </header>
                            <div class="widget-time-content">
                                <div class="caption"><b>Total Pengeluaran</b></div>
                                <div class="number"><b>
                                    @foreach ($peng as $item)
                                    <div id="ftpeng">Rp. {{number_format($item->total)}}</div> 
                                    <div id="tpeng">{{$item->total}}</div>
                                    @endforeach
                                </b>
                                </div> 
                                <hr>
                                <div class="caption"><b>Total Gaji Karyawan</b></div>
                                <div class="number"><b>
                                    @foreach ($gaj as $g)
                                    <div id="ftgaj">Rp. {{number_format($g->total)}}</div> 
                                    <div id="tgaj">{{$g->total}}</div>
                                    @endforeach
                                </b>
                                </div>
                                <hr>
                                <div class="caption"><b>Total Transfer</b></div>
                                <div class="number"><b>
                                    @foreach ($ttf as $tff)
                                    <div id="ftff">Rp. {{number_format($tff->total)}}</div> 
                                    <div id="tff">{{$tff->total}}</div>
                                    @endforeach
                                </b>
                                </div>                                
                            </div>
                            </section>
                        </div>                                      
                        <div class="col-xl-12 dahsboard-column">   
                                @if (Session('msg'))
                                    <div class="alert alert-primary alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>   
                                        {{Session('msg')}}                                     
                                    </div>                             
                                @endif           
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif                     
                            <div class="card">
                                <div class="card-header">
                                Transfer Ke Pusat
                                </div>                      
                                <div class="card-body">
                                   <form action="{{url('simpan-tf')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-6 dashboard-column">
                                                <div class="form-group">
                                                    <label for="">Tanggal</label>
                                                    <input type="text" class="form-control" name="tgl" readonly value="{{ date("Y-m-d") }}">                                            
                                                </div>
                                            </div>
                                            <div class="col-xl-6 dashboard-column">
                                                <div class="form-group">
                                                    <label for="">Admin</label>
                                                    <input type="text" class="form-control" name="admin" readonly value="{{Session::get('username')}}" >
                                                </div>
                                            </div>
                                            <div class="col-xl-6 dashboard-column">
                                                <div class="form-group">
                                                    <label for="">Keterangan</label>
                                                    @foreach ($kat as $k)
                                                        <input type="hidden" readonly class="form-control" name="kokat" value="{{$k->kode}}" >    
                                                        <input type="text" readonly class="form-control" name="kat" value="{{$k->nama}}" >    
                                                    @endforeach                                                    
                                                </div>
                                            </div>
                                            <div class="col-xl-6 dashboard-column">
                                                <div class="form-group">
                                                    <label for="">Nominal</label>
                                                    <input type="text" required id="nm" class="form-control" name="nominal" placeholder="Masukan Jumlah Transfer" >
                                                    <input type="hidden" required id="sl" class="form-control" name="sal" >
                                                </div>
                                            </div>
                                            <div class="col-xl-6 dashboard-column">
                                                <div class="form-group">
                                                    <label for="">Bukti Transfer</label>
                                                    <input type="file" required class="form-control" name="bukti" placeholder="Masukan Jumlah Transfer" >
                                                </div>
                                            </div>
                                            <div class="col-xl-12 dashboard-column">
                                                <div class="form-group">
                                                    <br>
                                                    <Button type="submit" class="btn btn-primary pull-right">Transfer</Button>
                                                </div>
                                            </div>
                                        </div>
                                   </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="col-xl-4 dahsboard-column">
                        <div class="card">
                            <div class="card-header">
                              Saldo Bersih Rp. <div class="sal">0</div>
                            </div>                      
                            <div class="card-body">
                                <table class="table table-responsive table-bordered">
                                    <tbody>
                                        <tr>
                                            <td align="center" colspan="2"> History Transaksi</td>
                                        </tr>
                                        <tr>
                                            <td align="center" >Tanggal</td>
                                            <td align="center" >Nominal</td>
                                        </tr>
                                        @foreach ($tf as $tra)
                                        <tr>
                                            <td align="center" >{{$tra->tgl_tf}} </td>
                                            <td>Rp {{number_format($tra->nominal)}}</td>
                                        </tr>    
                                        @endforeach                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>    
@endsection
@section('js')
    <script>
        $('document').ready(function(){
            $('#tres').hide();
            $('#tin').hide();
            $('#tpeng').hide();
            $('#tgaj').hide();
            $('#tff').hide();
            
        });
        function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}
        var tres=$('#tres').html();
        var tin=$('#tin').html();
        var tpeng=$('#tpeng').html();
        var tgaj=$('#tgaj').html();
        var tff=$('#tff').html();

        var sal=Number(tres)+Number(tin)-Number(tpeng)-Number(tgaj)-Number(tff); 
        $('#sl').val(sal);
        $('.sal').html(numberWithCommas(sal));
        $("[id='nm']").on('keyup', function(){
        var n = parseInt($(this).val().replace(/\D/g,''),10);
        $(this).val(n.toLocaleString());
    });
    </script>
@endsection