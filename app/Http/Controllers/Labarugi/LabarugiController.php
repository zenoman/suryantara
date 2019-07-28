<?php
namespace App\Http\Controllers\Labarugi;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Laporakudetnmodel;

// use Illuminate\Support\Facades\Response;
// use Illuminate\Support\Facades\File;
class LabarugiController extends Controller
{

    public function pilihllaba()
    {
        $tahun = DB::table('pengeluaran_lain')
        ->select(DB::raw('YEAR(tgl) as tahun'))
        ->groupby('tahun')
        ->orderby('tahun','desc')
        ->get();

        $setting = DB::table('setting')->get();
        $kategori = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama,tb_kategoriakutansi.kode'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->groupby('pengeluaran_lain.kategori')
            ->get();
        return view('labarugi/pilihlabarugi',['title'=>$setting,'kate'=>$kategori,'thn'=>$tahun]);
    }

    public function tampillaba(Request $request){
        $rules = [
            'tgl' => 'required',
            'tgl0' => 'required',
            'kategori' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);
        $kate=$request->kategori;
        $tgl = $request->tgl;
        $tgl0 = $request->tgl0;
        $tgll= $tgl. "Sampai" .$tgl0;
        if ($kate == 'semua') {
            $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            ->paginate(40);
            $totdat= DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            ->get();

            $data0 =DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where([['tb_kategoriakutansi.status','=','pendapatan'],['pengeluaran_lain.kategori','!=','012']])
            ->paginate(40);

            $totdat0 = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where([['tb_kategoriakutansi.status','=','pendapatan'],['pengeluaran_lain.kategori','!=','012']])
            ->get();
        }else{

            $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('pengeluaran_lain.kategori','=',$kate)
            ->paginate(40);
            $totdat= DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('pengeluaran_lain.kategori','=',$kate)
            ->get();

            $data0 =DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where([['tb_kategoriakutansi.status','=','pendapatan'],['pengeluaran_lain.kategori','!=','012']])
            ->paginate(40);

            $totdat0 = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where([['tb_kategoriakutansi.status','=','pendapatan'],['pengeluaran_lain.kategori','!=','012']])
            ->get();
        }

        $webinfo = DB::table('setting')->limit(1)->get();
    return view('labarugi/laporlabarugi',['tot0'=>$totdat0,'tot'=>$totdat,'data'=>$data,'data0'=>$data0,'title'=>$webinfo,'kate'=>$kate ,'tgl'=>$tgl,'tgl0'=>$tgl0,'ttg'=>$tgll]);
    // return view('labarugi/laporlabarugi',['data0'=>$data0,'data'=>$data,'title'=>$webinfo]);
    }

    public function tampillabathn(Request $request){
        $rules = [
            'thn' => 'required',
            'tahun' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);
        $thn = $request->thn;
        $tgl = $request->tahun;
            $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereYear('pengeluaran_lain.tgl',$tgl)
            ->groupby('pengeluaran_lain.kategori')
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            ->paginate(40);
            foreach ($data as $ros) {
            $total[] = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->whereYear('pengeluaran_lain.tgl',$tgl)
            ->where('pengeluaran_lain.kategori','=',$ros->kategori)
            ->get();
            }

            $totdat= DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereYear('pengeluaran_lain.tgl',$tgl)
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            ->get();

            $data0 =DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereYear('pengeluaran_lain.tgl',$tgl)
            ->groupby('pengeluaran_lain.kategori')
            ->where([['tb_kategoriakutansi.status','=','pendapatan'],['pengeluaran_lain.kategori','!=','012']])
            ->paginate(40);
            foreach ($data0 as $ross) {
            $total0[] = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->whereYear('pengeluaran_lain.tgl',$tgl)
            ->where('pengeluaran_lain.kategori','=',$ross->kategori)
            ->get();
            }

            $totdat0 = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereYear('pengeluaran_lain.tgl',$tgl)
            ->where([['tb_kategoriakutansi.status','=','pendapatan'],['pengeluaran_lain.kategori','!=','012']])
            ->get();
        
        $webinfo = DB::table('setting')->limit(1)->get();
return view('labarugi/laporlabarugithn',['tot0'=>$totdat0,'tot'=>$totdat,'data'=>$data,'data0'=>$data0,'title'=>$webinfo,'tgl'=>$tgl,'thn'=>$thn,'toto'=>$total,'toto0'=>$total0]);
    }

        public function cetaklaba($tgl){
            $thn= $tgl;
            $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereYear('pengeluaran_lain.tgl',$tgl)
            ->groupby('pengeluaran_lain.kategori')
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            ->paginate(40);
            foreach ($data as $ros) {
            $total[] = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->whereYear('pengeluaran_lain.tgl',$tgl)
            ->where('pengeluaran_lain.kategori','=',$ros->kategori)
            ->get();
            }
            $totdat= DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereYear('pengeluaran_lain.tgl',$tgl)
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            ->get();

            $data0 =DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereYear('pengeluaran_lain.tgl',$tgl)
            ->groupby('pengeluaran_lain.kategori')
            ->where([['tb_kategoriakutansi.status','=','pendapatan'],['pengeluaran_lain.kategori','!=','012']])
            ->paginate(40);
            foreach ($data0 as $ross) {
            $total0[] = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->whereYear('pengeluaran_lain.tgl',$tgl)
            ->where('pengeluaran_lain.kategori','=',$ross->kategori)
            ->get();
            }

            $totdat0 = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereYear('pengeluaran_lain.tgl',$tgl)
            ->where([['tb_kategoriakutansi.status','=','pendapatan'],['pengeluaran_lain.kategori','!=','012']])
            ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('labarugi/printlaba',['tot0'=>$totdat0,'tot'=>$totdat,'data'=>$data,'data0'=>$data0,'title'=>$webinfo,'thn'=>$thn,'toto'=>$total,'toto0'=>$total0]);
    }





}
