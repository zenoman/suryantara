<?php

namespace App\Http\Controllers\Absensi;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Absensimodel;

use App\Exports\AbsensiharianExport;
use App\Exports\AbsensibulananExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\File;
class Absensicontroller extends Controller
{
    public function index()
    {  
        $dattgl=date('Y-m-d');
        $datKaryawan = DB::table('karyawan')
                ->select('karyawan.id','karyawan.kode','karyawan.nama','karyawan.id_jabatan','absensi.id_karyawan')
                ->leftJoin('absensi',function ($join) {
                $join->on('absensi.id_karyawan', '=' , 'karyawan.id') ;
                $join->where('absensi.tanggal','=', date('Y-m-d')) ;
            })
                ->paginate(20);
        $setting = DB::table('setting')->get();
        // dd($datKaryawan);
        return view('absensi/index',['karyawan'=>$datKaryawan,'title'=>$setting,'tanggal'=>$dattgl]);

      }
//-------------------------
        public function tambahdataabsen(Request $request)
    {
        $ma_tima = $request->ma_tima;
        if ($ma_tima == 'masuk') {
            $masuk=1;
            $bolos=0;
            $izin=0;
            $ketiz="-";
        }elseif($ma_tima == 'tidak_masuk') {
            $masuk=0;
            $bolos=1;
            $izin=0;
            $ketiz="-";
        }else{
            $masuk = 0;
            $bolos = 0;
            $izin = 1;
            $ketiz = $request->ketizin;
        }
        Absensimodel::create([
            'id_karyawan'  => $request->id_karyawan,
            'id_jabatan'  => $request->id_jabatan,
            'tanggal' =>$request->tanggal,
            'masuk'=>$masuk,
            'izin'=>$izin,
            'keterangan_izin'=>$ketiz,
            'tidak_masuk'=>$bolos

        ]);
        
        return redirect('absen')->with('status','Input Data Sukses');
    }
    //--------------------------------
    public function pilihabsenhari()
    {
        $setting = DB::table('setting')->get();
            $ambiltgl = DB::table('absensi')
            ->groupby('tanggal')
            ->get();
        $datAbsensi = DB::table('absensi')
                ->select('absensi.*','jabatan.jabatan')
                ->leftjoin('jabatan', 'jabatan.id', '=', 'absensi.id_jabatan')
                ->groupby('jabatan')
                ->paginate(20);
                return view('absensi/pilihabsensiharian',['absen'=>$datAbsensi,'title'=>$setting,'tgl'=>$ambiltgl]);
    }
    public function pilihabsenbulan()
    {
        $setting = DB::table('setting')->get();
        $ambiltgl = DB::table('absensi')
        ->select(DB::raw('MONTH(tanggal) as bulan, YEAR(tanggal) as tahun'))
        ->groupby('bulan')
        ->groupby('tahun')
        ->get();
        // $dattgl=date('Y-m-d');
        // dd($ambiltgl);
        $datAbsensi = DB::table('absensi')
                ->select('absensi.*','jabatan.jabatan')
                ->leftjoin('jabatan', 'jabatan.id', '=', 'absensi.id_jabatan')
                ->paginate(20);
                return view('absensi/pilihabsensibulanan',['absen'=>$datAbsensi,'title'=>$setting,'tgl'=>$ambiltgl]);
    }

    public function tampilabsenharian(Request $request){
        $rules = [
            'tanggal' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);
        $namajabatan = $request->jabatan;
        $tgl = $request->tanggal;
        
        if($namajabatan=='semua'){
            $idjabatan = 'semua';
            $jabat = 'semua';
            $data = DB::table('absensi')
            ->select(DB::raw('absensi.*,jabatan.jabatan,karyawan.nama,karyawan.kode'))
            ->leftjoin('jabatan','jabatan.id','=','absensi.id_jabatan')
            ->leftjoin('karyawan','karyawan.id','=','absensi.id_karyawan')
            ->where([['absensi.tanggal','=',$tgl]])
            ->paginate(40);

        }else{
        $jabatan = explode('-',$namajabatan);
        $idjabatan = $jabatan[0];
        $jabat = $jabatan[1];

        $data = DB::table('absensi')
            ->select(DB::raw('absensi.*,jabatan.jabatan,karyawan.nama,karyawan.kode'))
            ->leftjoin('jabatan','jabatan.id','=','absensi.id_jabatan')
            ->leftjoin('karyawan','karyawan.id','=','absensi.id_karyawan')
            ->where([['absensi.tanggal','=',$tgl],['absensi.id_jabatan','=',$idjabatan]])
            ->paginate(20);
        }
        // dd($data);
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('absensi/absensiharian',['tanggal'=>$tgl,'kodejabatan'=>$namajabatan,'data'=>$data,'title'=>$webinfo,'jabatan'=>$idjabatan,'jbtnama'=>$jabat,'data3'=>$data->appends(request()->input())
    ]);
    }
    public function tampilabsenbulanan(Request $request){
        $rules = [
            'tanggal' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);
        $namajabatan = $request->jabatan;
        $tgl = $request->tanggal;
        $bulan = explode('-', $tgl);
        $thn = $bulan[0];
        $bln = $bulan[1];

        if($namajabatan=='semua'){
            $idjabatan = 'semua';
            $jabat = 'semua';
            $data = DB::table('absensi')
            ->select(DB::raw('absensi.*,jabatan.jabatan,karyawan.nama,karyawan.kode'))
            ->leftjoin('jabatan','jabatan.id','=','absensi.id_jabatan')
            ->leftjoin('karyawan','karyawan.id','=','absensi.id_karyawan')
            ->whereMonth('absensi.tanggal',$bln)
            ->whereYear('absensi.tanggal',$thn)
            ->paginate(40);

        }else{
        $jabatan = explode('-',$namajabatan);
        $idjabatan = $jabatan[0];
        $jabat = $jabatan[1];

        $data = DB::table('absensi')
            ->select(DB::raw('absensi.*,jabatan.jabatan,karyawan.nama,karyawan.kode'))
            ->leftjoin('jabatan','jabatan.id','=','absensi.id_jabatan')
            ->leftjoin('karyawan','karyawan.id','=','absensi.id_karyawan')
            ->whereMonth('absensi.tanggal',$bln)
            ->whereYear('absensi.tanggal',$thn)
            ->where('absensi.id_jabatan','=',$idjabatan)
            ->paginate(20);
        }
        // dd($tgl);
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('absensi/absensibulanan',['tanggal'=>$tgl,'kodejabatan'=>$namajabatan,'data'=>$data,'title'=>$webinfo,'jabatan'=>$idjabatan,'jbtnama'=>$jabat,'data3'=>$data->appends(request()->input())
    ]);
    }
        public function exsportabsensiharian($tanggal, $jabatan){
            $namafile = "Export absensi harian pada tgl ".$tanggal.".xlsx";
        return Excel::download(new AbsensiharianExport($tanggal,$jabatan),$namafile);
    }
        public function exsportabsensibulanan($tanggal, $jabatan){

            $namafile = "Export absensi bulanan pada bulan ".$tanggal.".xlsx";
        return Excel::download(new AbsensibulananExport($tanggal,$jabatan),$namafile);
    }
        public function cetakabsensihrian($tanggal,$kodejabatan){
        $namajabatan =$kodejabatan;
        
        if($namajabatan=='semua'){
            $idjabatan = 'semua';
            $jabat = 'semua';
            $data = DB::table('absensi')
            ->select(DB::raw('absensi.*,jabatan.jabatan,karyawan.nama,karyawan.kode'))
            ->leftjoin('jabatan','jabatan.id','=','absensi.id_jabatan')
            ->leftjoin('karyawan','karyawan.id','=','absensi.id_karyawan')
            ->where([['tanggal','=',$tanggal]])
            ->paginate(40);
        }else{
        $jabatan = explode('-',$namajabatan);
        $idjabatan = $jabatan[0];
        $jabat = $jabatan[1];
        $data = DB::table('absensi')
            ->select(DB::raw('absensi.*,jabatan.jabatan,karyawan.nama,karyawan.kode'))
            ->leftjoin('jabatan','jabatan.id','=','absensi.id_jabatan')
            ->leftjoin('karyawan','karyawan.id','=','absensi.id_karyawan')
            ->where([['absensi.tanggal','=',$tanggal],['absensi.id_jabatan','=',$idjabatan]])
            ->paginate(20);
        }
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('absensi/cetakaabsensiharian',[
     'data'=>$data,'title'=>$webinfo,'tgl'=>$tanggal,'jabatan'=>$jabat,'kodejabatan'=>$idjabatan
    ]);
    }

        public function cetakabsensibulanan($tanggal,$kodejabatan){
        $bulan = explode('-', $tanggal);
        $thn = $bulan[0];
        $bln = $bulan[1];
        $namajabatan =$kodejabatan;
        
        if($namajabatan=='semua'){
            $idjabatan = 'semua';
            $jabat = 'semua';
            $data = DB::table('absensi')
            ->select(DB::raw('absensi.*,jabatan.jabatan,karyawan.nama,karyawan.kode'))
            ->leftjoin('jabatan','jabatan.id','=','absensi.id_jabatan')
            ->leftjoin('karyawan','karyawan.id','=','absensi.id_karyawan')
            ->whereMonth('absensi.tanggal',$bln)
            ->whereYear('absensi.tanggal',$thn)
            ->paginate(40);
        }else{
        $data = DB::table('absensi')
            ->select(DB::raw('absensi.*,jabatan.jabatan,karyawan.nama,karyawan.kode'))
            ->leftjoin('jabatan','jabatan.id','=','absensi.id_jabatan')
            ->leftjoin('karyawan','karyawan.id','=','absensi.id_karyawan')
            ->whereMonth('absensi.tanggal',$bln)
            ->whereYear('absensi.tanggal',$thn)
            ->where('absensi.id_jabatan','=',$namajabatan)
            ->paginate(20);
        }
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('absensi/cetakaabsensiharian',[
     'data'=>$data,'title'=>$webinfo,'tgl'=>$tanggal,'jabatan'=>$namajabatan
    ]);
    }





}