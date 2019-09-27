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
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/pnotify.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/pages/others.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/select2.min.css')}}">
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
                <div class="section-header">
                    <div class="tbl">
                        <div class="tbl-row">
                            <div class="tbl-cell">
                                <h3>Halaman Pembukuan</h3>
                            </div>
                        </div>
                    </div>
                </div>
                    @if (Session('msg'))
                        <div class="alert alert-primary alert-dismissible" role="alert">
                        <p align="center">{{Session('msg')}}</p> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        </div>
                    @endif 
                <div class="row">    
                    <div class="col-xl-9 dashboard-col">
                        <div class="row">
                            <div class="col-xl-4 dahsboard-column">
                                <div class="card">
                                    <div class="add-customers-screen tbl">
                                        <div class="add-customers-screen-in">
                                            <div class="add-customers-screen-user">
                                                <i class="fa fa-external-link"></i>
                                            </div>
                                            <a href="{{url('pengeluaranlain')}}" class="btn btn-primary-outline btn-sm">Input Pengeluaran Harian</a>                                                                                   
                                        </div>
                                    </div>
                                </div>                    
                                </div>  
                                 <div class="col-xl-4 dahsboard-column">
                                <div class="card">
                                    <div class="add-customers-screen tbl">
                                        <div class="add-customers-screen-in">
                                            <div class="add-customers-screen-user">
                                                <i class="fa fa-cc-discover"></i>
                                            </div>
                                            <a href="{{url('laporanpengeluarangjkw')}}" class="btn btn-primary-outline btn-sm">Gaji Karyawan</a>
                                        </div>
                                    </div>
                                </div>                            
                                </div>                       
                                <div class="modal fade in" id="addmodal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Tambahkan Modal
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('add-modal')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="">Bulan</label>
                                                    <input type="text" name="bl" class="form-control" readonly value="{{date('n')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Tahun</label>
                                                    <input type="text" name="th" class="form-control" readonly value="{{date('Y')}}">
                                                </div>
                                                <div class="form-group">                                            
                                                    <input type="text" required name="modal"  class="form-control nominal" placeholder="Masukan Modal">
                                                </div>
                                                <div class="form-body">
                                                    <Button type="submit" class="btn btn-primary-outline btn-sm pull-right mr-2">Simpan</Button>
                                                    <Button class="btn btn-danger-outline btn-sm pull-right mr-2" data-dismiss="modal">Tutup</Button>                                            
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>                
                                <div class="col-xl-4 dahsboard-column">
                                <div class="card">
                                    <div class="add-customers-screen tbl">
                                        <div class="add-customers-screen-in">
                                            <div class="add-customers-screen-user">
                                                <i class="fa fa-share-alt"></i>
                                            </div>
                                            <p></p>
                                            <Button data-toggle="modal" data-target="#transfer" class="btn btn-primary-outline btn-sm">Transfer Ke Pusat</Button>
                                        </div>
                                    </div>                            
                                </div>                           
                                </div> 
                                {{-- Modal Transfer --}}
                                <div class="modal fade in" id="transfer">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Transfer Ke Pusat Cabang
                                        </div>
                                        <div class="modal-body">
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
                                                        <div class="col-xl-12 dashboard-column">
                                                            <div class="form-group">
                                                                <label for="">Cabang Tujuan</label>
                                                                <select name="idc" class="form-control" aria-readonly="true" id="">
                                                                    @foreach ($cab as $item)
                                                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                                                    @endforeach                                                            
                                                                </select>
                                                            </div>
                                                        </div>       
                                                        <div class="col-xl-12 dashboard-col">
                                                            <div class="form-group text-center">
                                                                <img id="imgv" src="{{asset('img/img-trans.jpg')}}" class="img-thumbnail" width="300px" height="200px" alt="" >
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 dashboard-column">
                                                            <div class="form-group">
                                                                <label for="">Bukti Transfer</label>
                                                                <input type="file" id="imgtf" required class="form-control" name="bukti" placeholder="Masukan Jumlah Transfer" >
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 dashboard-column">
                                                            <div class="form-group">
                                                                <label for="">Nominal yang Di transfer</label>
                                                                <input type="text"  required id="nm" class="form-control nominal" name="nominal" placeholder="Masukan Jumlah Transfer" >                                                        
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-xl-6 dashboard-column">
                                                            <div class="form-group">
                                                                <label for="">Sisa Saldo</label>
                                                                <input type="text" id="sisal" class="form-control" name="sisal" readonly value="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 dashboard-column">
                                                            <div class="form-group form-inline">
                                                                <label for="" class="mr-2">Batas Sisa Saldo </label> 
                                                                <label for="">Rp. {{number_format($sal->saldo)}}</label>
                                                                <input type="hidden" readonly  class="form-control nominal" value="{{$sal->saldo}}" name="bsal" placeholder="Masukan Jumlah Transfer" >                                                        
                                                            </div>
                                                        </div> 
                                                        <div class="col-xl-12 dashboard-column">
                                                            <div class="form-group form-inline">
                                                                <label for="" class="mr-2">Total Debit </label> 
                                                                <label for="">Rp. {{number_format($in)}}</label>                                                        
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 dashboard-column">
                                                            <div class="form-group form-inline">
                                                                <label for="" class="mr-2">Total Kredit </label> 
                                                                <label for="">Rp. {{number_format($kred)}}</label>                                                        
                                                            </div>
                                                        </div> --}}
                                                        <div class="col-xl-12 dashboard-column">
                                                            <p id="msg"></p>
                                                        </div>
                                                        <div class="col-xl-12 dashboard-column">
                                                            <div class="form-group">
                                                                <br>
                                                                <Button data-dismiss="modal" class="btn btn-danger-outline btn-sm   pull-right mr-2">Tutup</Button>
                                                                @if (Session::get('cabang')!='1')
                                                                    <Button type="submit" id="btntf" class="btn btn-primary-outline btn-sm pull-right mr-2">Transfer</Button>
                                                                @endif                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                               </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-xl-4 dahsboard-column">
                                <div class="card">
                                    <div class="add-customers-screen tbl">
                                        <div class="add-customers-screen-in">
                                            <div class="add-customers-screen-user">
                                                <i class="fa fa-bookmark-o"></i>
                                            </div>
                                            <a href="{{url('kat_akut')}}"  class="btn btn-primary-outline btn-sm">Kategori Akuntansi</a>                                                                                   
                                        </div>
                                    </div>
                                </div>                                    
                                </div>                    
                            <div class="col-xl-4 dahsboard-column">
                                <div class="card">
                                    <div class="add-customers-screen tbl">
                                        <div class="add-customers-screen-in">
                                            <div class="add-customers-screen-user">
                                                <i class="fa fa-car"></i>
                                            </div>
                                            {{-- <Button data-target="#kendaraan" data-toggle="modal" class="btn btn-primary-outline btn-sm">Bayar Pajak Kendaraan</Button>    --}}
                                            <a href="{{url('armada')}}" class="btn btn-primary-outline btn-sm">Bayar Pajak Kendaraan</a>
                                        </div>
                                    </div>
                                </div>                       
                            </div>
                                {{-- Modal Kendaraan --}}
                                {{-- <div class="modal fade in" id="kendaraan">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="modal-title">
                                                    List Armada
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Nomor</th>
                                                            <th>Armada</th>
                                                            <th>No Polisi</th>
                                                            <th>Nomor Rangka</th>
                                                            <th>Nomor Mesin</th>
                                                            <th>Warna</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-xl-4 dahsboard-column">
                                    <div class="card">
                                        <div class="add-customers-screen tbl">
                                            <div class="add-customers-screen-in">
                                                <div class="add-customers-screen-user">
                                                    <i class="fa fa-signal"></i>
                                                </div>
                                                {{-- <Button data-target="#kendaraan" data-toggle="modal" class="btn btn-primary-outline btn-sm">Bayar Pajak Kendaraan</Button>    --}}
                                                <a href="{{url('laba-rugi')}}" class="btn btn-primary-outline btn-sm">Laba Rugi</a>
                                            </div>
                                        </div>
                                    </div>                       
                                </div>
                                <div class="col-xl-4 dahsboard-column">
                                    <div class="card">
                                        <div class="add-customers-screen tbl">
                                            <div class="add-customers-screen-in">
                                                <div class="add-customers-screen-user">
                                                    <i class="fa fa-gavel"></i>
                                                </div>                                                
                                                <button data-target="#kasbon" data-toggle="modal" class="btn btn-primary-outline btn-sm">Bon Gaji</a>
                                            </div>
                                        </div>
                                    </div>                       
                                </div>
                            </div>
                        </div>
                        {{-- Modal Kasbon --}}
                        <div class="modal fade in" id="kasbon">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Bon Karyawan
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('simpan-bon')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Karyawan</label>
                                               <select id="pilkar" name="kar" class="select2" name="karyawan" id="">
                                                   <option disabled hidden selected>Pilih</option>
                                                    @foreach ($kar as $item)
                                                        <option value="{{$item->kode}}">{{$item->nama}}</option>
                                                    @endforeach
                                               </select>
                                            </div>                                            
                                            <div class="form-group form-inline">
                                                <label class="mr-2" for="">Batas Kasbon </label>
                                                <label for="" id="batas">Loading......</label>
                                            </div>                                            
                                            <div class="form-group form-inline">
                                                <label class="mr-2" for="">Tunggakan Bon </label>
                                                <label for="" id="bon" >Loading......</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Masukan Kasbon</label>
                                                <input type="text" required name="nbon" class="form-control nbon">
                                            </div>
                                            <div class="form-group">
                                                <span class="ingat"></span>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <Button id="savebon" type="submit" class="btn btn-primary-outline btn-sm">Simpan</Button>
                                        <Button class="btn btn-danger-outline btn-sm" data-dismiss="modal">Tutup</Button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 dashboard-column">
                            <div class="card">
                                <div class="add-customers-screen tbl">
                                    <div class="add-customers-screen-in">
                                        <div class="add-customers-screen-user">
                                            <i class="fa fa-percent"></i>
                                        </div>
                                        <p>Pembayaran Pajak </p>
                                        <?php 
                                        // get tgl pertama bulan sebelumnya
                                        $tglawal=date('Y-m-d',strtotime('first day of previous month'));
                                        $tglakhir=date('Y-m-d',strtotime('last day of previous month'));
                                        echo "".$tglawal." sampai ";
                                        echo $tglakhir."<br>";
                                        // Akumulasi
                                        $tglawal=date('Y-m-d',strtotime('first day of previous month'));
                                        $tglakhir=date('Y-m-d',strtotime('last day of previous month'));
                                        $lasbul=date('n',strtotime('last day of previous month'));
                                        $lastth=date('Y',strtotime('last day of previous month'));
                                        $tot=DB::table('resi_pengiriman')
                                            ->select(DB::raw('sum(total_biaya) as total'))
                                            ->whereBetween('tgl',[$tglawal,$tglakhir])
                                            ->where('duplikat','!=','Y')
                                            ->first(); 
                                        $tresi=$tot->total;        
                                        // ambil Persen pajak dari setting
                                        $persen=DB::table('setting_pajak')
                                                ->where('tempo','bulan')
                                                ->first();
                                        $pjsen=$persen->besaran;
                                        $pajak=$tresi*$pjsen/100;
                                        ?> 
                                        <ul>
                                            <li>Penghasilan Resi: Rp. <b>{{number_format($tresi) }}</b></li>
                                            <li>Besaran Pajak: <b>{{$pjsen}} %</b></li>
                                            <li>Pajak Terbayar: Rp.<b> {{number_format($pajak)}}</b></li>
                                        </ul>                                     
                                        <br>
                                        <div class="label label-light label-primary">Pembayaran Pajak Secara otomatis</div>           
                                    </div>
                                </div>
                            </div>
                        </div>  
                </div>                
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('assets/js/lib/notie/notie.js')}}"></script>
<script src="{{asset('assets/js/lib/select2/select2.full.min.js')}}"></script> 
    <script>
        // // Cek Bila Sudah Transfer
        // var cbul={{$cekbul}};
        // if(cbul>0){
        //     $('#btntf').prop('disabled',true); 
        //     $('#msg').html('Transfer Sudah Dilakukan !')
        // }
        // // set otomatis nominal saldo yang dtransfer
        // var batas={{$sal->saldo}};
        // var tsal={{$in}};
        // var kred={{$kred}}
        // var tf=tsal-kred-batas;
        // var sis=tsal-tf-kred;
        // var batasbon=0;
        // if(tf<0){
        //     tf=0;
        // }
        // if(tf<batas){
        //     $('#btntf').prop('disabled',true); 
        // }else{
        //     $('#sisal').val(sis);
        // }

        $('.nominal').on('keyup', function(){
        var n = parseInt($(this).val().replace(/\D/g,''),10);
        $(this).val(n.toLocaleString());
        }); 
        
        // // hitung nilai
        // $('#sisal').val(sis);
        // if(sisa<batas){
        //     $('#btntf').prop('disabled',true);              
        // }else{
        //     $('#btntf').prop('disabled',false);
        // }
        // }); 
        // format number
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
       
        // $('#nm').val(numberWithCommas(tf));
        // Pilih Bon
        $('#pilkar').on('select2:select',function(e){
            var kode=$(this).val();
            $.ajax({
                type:'GET',
                url:'ambil-bon/'+kode,
                success:function(response){
                    $.each(response,function(key,value){
                        $('#batas').html("Rp. "+numberWithCommas(value.batas_bon));
                        if(value.bon==null){
                            batasbon=value.batas_bon;
                            $('#bon').html("Rp. "+0);
                        }else if(value.bon==0){                            
                            batasbon=value.batas_bon;
                            $('#bon').html("Rp. "+numberWithCommas(value.bon));
                        }else{
                            $('#bon').html("Rp. "+numberWithCommas(value.bon));
                            $('#savebon').prop('disabled',true);
                        }
                    });
                }
            });
        });
        $('.nbon').on('keyup', function(){
            var n = parseInt($(this).val().replace(/\D/g,''),10);
            $(this).val(n.toLocaleString());
            nombon=n;
            if(batasbon<nombon){
                $('#savebon').prop('disabled',true);                
                $('.ingat').html('<div class="alert alert-info">Bon melebihi batas</div>');
            }else{
                $('#savebon').prop('disabled',false);
                $('.ingat').html('');
            }
            
        });
        // read image
        function simage(input){
            if(input.files && input.files[0]){
                var reader=new FileReader();
                reader.onload=function(e){
                    $('#imgv').attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#imgtf').change(function(){
            simage(this);
        });
    </script>
@endsection