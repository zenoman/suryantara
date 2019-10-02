<!DOCTYPE html>
<html>
<head>
	<title>Cetak Rekap Penyusutan Aset</title>
	<link rel="stylesheet" href="{{asset('assets/css/lib/bootstrap/bootstrap.min.css')}}">	
	<style>
		@page{
			size:landscape;
		}
	</style>
</head>
<body>
        <div>
                <table style="width: 100%;" border="0">
                    <tr>
                        <td style="width: 25%" align="center">
                            <img src="{{asset('img/LOGO1.png')}}" alt="" width="50%">
                        </td>
                        <td style="width: 50%" align="center" >
                        <p style="font-size:10;">
                            <b style="font-size: 20;">KADIRI LOGISTIK CARGO</b><br>
                            Kantor Pusat : Jln. Raya Dadapan - sumberejo Kab. Kediri (0354-4545192) <br>
                            {{Session::get('kop')}}
                        </p>
                        </td>
                        <td style="width: 25%;font-size: 9;">								
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
        <div class="page-content">
                <div class="container-fluid">                   
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
                        </div>
                    </div>
                </div>
            </div>
    
    
    <script src="{{asset('assets/js/lib/jquery/jquery-3.2.1.min.js')}}"></script>
    <script>
        $(document).ready(function(){	    
            window.print();
        })
            window.onafterprint = function() {
            history.go(-1);
        };
    </script>   
</body>
</html>