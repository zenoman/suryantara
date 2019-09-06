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
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\File;
class Absensicontroller extends Controller
{
    public function index()
    {  
        $dattgl=date('Y-m-d');
        $datKaryawan = DB::table('karyawan')
                ->select(DB::raw('karyawan.*,jabatan.uang_makan,absensi.id_karyawan'))
                ->leftJoin('jabatan',function($joon){
                    $joon->on('jabatan.id','=','karyawan.id_jabatan');

                })
                ->leftJoin('absensi',function ($join) {
                $join->on('absensi.id_karyawan', '=' , 'karyawan.id') ;
                $join->where('absensi.tanggal','=', date('Y-m-d')) ;
                })
                ->where('karyawan.id_cabang','=',Session::get('cabang'))
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
            $makan=$request->uangmaem;
        }elseif($ma_tima == 'tidak_masuk') {
            $masuk=0;
            $bolos=1;
            $izin=0;
            $ketiz="-";
            $makan=0;
        }else{
            $masuk = 0;
            $bolos = 0;
            $izin = 1;
            $ketiz = $request->ketizin;
            $makan=0;
        }
        Absensimodel::create([
            'id_karyawan'  => $request->id_karyawan,
            'id_jabatan'  => $request->id_jabatan,
            'tanggal' =>$request->tanggal,
            'masuk'=>$masuk,
            'izin'=>$izin,
            'keterangan_izin'=>$ketiz,
            'tidak_masuk'=>$bolos,
            'uang_makan'=>$makan,
            'id_cabang'=>Session::get('cabang')
        ]);
        
        return redirect('absen')->with('status','Input Data Sukses');
    }
    public function tambahabsenselesai(Request $request){
         $datKaryawan = DB::table('karyawan')
                ->where('id_cabang',Session::get('cabang'))
                ->get();
                $dattgl=date('Y-m-d');
        $datAbsensi = DB::table('absensi')
                ->where('tanggal','=',$dattgl)
                ->get();
        foreach ($datKaryawan as $row) {
            $datAbsensi = DB::table('absensi')
                ->where([['tanggal','=',$dattgl],['id_karyawan','=',$row->id]])
                ->count();
            if($datAbsensi == 0){
            $masuk=0;
            $bolos=1;
            $izin=0;
            $ketiz="-";
            $data[] = [
                        'id_karyawan'  => $row->id,
                        'id_jabatan'  => $row->id_jabatan,
                        'tanggal' =>$dattgl,
                        'masuk'=>$masuk,
                        'izin'=>$izin,
                        'keterangan_izin'=>$ketiz,
                        'tidak_masuk'=>$bolos,
                        'uang_makan'=>0,
                        'id_cabang'=>Session::get('cabang')
                        ];
                    DB::table('absensi')->insert($data);
            
            }
          
        }
           
        return redirect('/dashboard')->with('status','Absensi karyawan selesai');
    }
    //--------------------------------
    public function pilihabsensi()
    {
        $setting = DB::table('setting')->get();
        $ambiltgl = DB::table('absensi')
        ->groupby('tanggal')
        ->get();
        $ambilbln = DB::table('absensi')
        ->select(DB::raw('MONTH(tanggal) as bulan, YEAR(tanggal) as tahun'))
        ->groupby('bulan')
        ->groupby('tahun')
        ->get();
        $datAbsensi = DB::table('absensi')
                ->select('absensi.*','jabatan.jabatan')
                ->leftjoin('jabatan', 'jabatan.id', '=', 'absensi.id_jabatan')
                ->groupby('jabatan')
                ->paginate(60);

                return view('absensi/pilihabsensi',['absen'=>$datAbsensi,'title'=>$setting,'tgl'=>$ambiltgl,'bln'=>$ambilbln]);
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
