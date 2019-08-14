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

        $kategori = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama,tb_kategoriakutansi.kode'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->groupby('pengeluaran_lain.kategori')
            ->get();
        $kategorirs = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,tb_kategoriakutansi.nama,tb_kategoriakutansi.kode'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','resi_pengiriman.katakun')
            ->groupby('resi_pengiriman.katakun')
            ->get();
        $kategorisj = DB::table('surat_jalan')
            ->select(DB::raw('surat_jalan.*,tb_kategoriakutansi.nama,tb_kategoriakutansi.kode'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','surat_jalan.katakun')
            ->groupby('surat_jalan.katakun')
            ->get();
        $kategoripj = DB::table('pajak')
            ->select(DB::raw('pajak.*,tb_kategoriakutansi.nama,tb_kategoriakutansi.kode'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pajak.katakun')
            ->groupby('pajak.katakun')
            ->get();


        $setting = DB::table('setting')->get();
        return view('labarugi/pilihlabarugi',['title'=>$setting,'kate'=>$kategori,'katers'=>$kategorirs,'katesj'=>$kategorisj,'katepj'=>$kategoripj,'thn'=>$tahun]);
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

        $am = explode('-', $tgl);
        $thn = $am[0];
        $bln = $am[1];

        $amb = explode('-', $tgl0);
        $thn0 = $amb[0];
        $bln0 = $amb[1];
        if ($kate == 'semua') {
            $kategor='semua';
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
            $pengsj = DB::table('surat_jalan')
            ->select(DB::raw('surat_jalan.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','surat_jalan.katakun')
            ->whereBetween('tgl',[$tgl,$tgl0])
            ->paginate(40);

            $pengoto = DB::table('surat_jalan')
            ->select(DB::raw('SUM(totalcash) as toto'))
            // ->whereMonth('tgl_lunas',$bulan
            ->whereBetween('tgl',[$tgl,$tgl0])
            ->get();
            $pengpj = DB::table('pajak')
            ->select(DB::raw('pajak.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pajak.katakun')
            ->whereBetween('bulan',[$bln,$bln0])
            ->whereBetween('tahun',[$thn,$thn0])
            ->paginate(40);

            $pengotopj = DB::table('pajak')
            ->select(DB::raw('SUM(total) as toto'))
            ->whereBetween('bulan',[$bln,$bln0])
            ->whereBetween('tahun',[$thn,$thn0])
            ->get();

            $dapat = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','resi_pengiriman.katakun')
            ->whereBetween('resi_pengiriman.tgl_lunas',[$tgl,$tgl0])
            ->paginate(40);
            $dapatoto = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as toto'))
            ->whereBetween('tgl_lunas',[$tgl,$tgl0])
            ->get();
            $webinfo = DB::table('setting')->limit(1)->get();
            return view('labarugi/laporlabarugi',['tot'=>$totdat,'data'=>$data,'title'=>$webinfo,'kate'=>$kate ,'tgl'=>$tgl,'tgl0'=>$tgl0,'ttg'=>$tgll,'kluar'=>$pengsj,'totkluar'=>$pengoto,'pjk'=>$pengpj,'totpjk'=>$pengotopj,'dapat'=>$dapat,'totdapat'=>$dapatoto,'kat'=>$kategor]);
        }else if($kate == 233){
            $kategor = "surjal";
            $peng = DB::table('surat_jalan')
            ->select(DB::raw('surat_jalan.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','surat_jalan.katakun')
            ->whereBetween('tgl',[$tgl,$tgl0])
            ->where('surat_jalan.katakun','=',$kate)
            ->paginate(40);
            $pengoto = DB::table('surat_jalan')
            ->select(DB::raw('SUM(totalcash) as toto'))
            // ->whereMonth('tgl_lunas',$bulan
            ->whereBetween('tgl',[$tgl,$tgl0])
            ->where('surat_jalan.katakun','=',$kate)
            ->get();
            $dapat = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','resi_pengiriman.katakun')
            ->whereBetween('resi_pengiriman.tgl_lunas',[$tgl,$tgl0])
            ->where('resi_pengiriman.katakun','=',1)
            ->paginate(40);
            $dapatoto = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as toto'))
            ->whereBetween('tgl_lunas',[$tgl,$tgl0])
            ->where('resi_pengiriman.katakun','=',1)
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

        $webinfo = DB::table('setting')->limit(1)->get();
            return view('labarugi/laporlabarugi',['tot0'=>$totdat0,'tot'=>$pengoto,'data'=>$peng,'data0'=>$data0,'title'=>$webinfo,'kate'=>$kate ,'tgl'=>$tgl,'tgl0'=>$tgl0,'ttg'=>$tgll,'dapat'=>$dapat,'totdapat'=>$dapatoto,'kat'=>$kategor]);

            }else if($kate ==211){
                $kategor = "pjk";
//======================================================pajak
            $peng = DB::table('pajak')
            ->select(DB::raw('pajak.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pajak.katakun')
            ->whereBetween('bulan',[$bln,$bln0])
            ->where('pajak.katakun','=',$kate)
            ->paginate(40);
            $pengoto = DB::table('pajak')
            ->select(DB::raw('SUM(total) as toto'))
            ->whereBetween('tahun',[$thn,$thn0])
            ->where('pajak.katakun','=',$kate)
            ->get();
//====================================================resi pengiriman
            $dapat = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi.kode','=','resi_pengiriman.katakun')
            ->whereBetween('resi_pengiriman.tgl_lunas',[$tgl,$tgl0])
            ->where('resi_pengiriman.katakun','=',1)
            ->paginate(40);
            $dapatoto = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as toto'))
            ->whereBetween('tgl_lunas',[$tgl,$tgl0])
            ->where('resi_pengiriman.katakun','=',1)
            ->get();
//==================================================== pegeluaran lain
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

        $webinfo = DB::table('setting')->limit(1)->get();
            return view('labarugi/laporlabarugi',['tot0'=>$totdat0,'tot'=>$pengoto,'data'=>$peng,'data0'=>$data0,'title'=>$webinfo,'kate'=>$kate ,'tgl'=>$tgl,'tgl0'=>$tgl0,'ttg'=>$tgll,'dapat'=>$dapat,'totdapat'=>$dapatoto,'kat'=>$kategor]);
            }else{
                $kategor = "tdksemua";
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

            $dapat = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','resi_pengiriman.katakun')
            ->whereBetween('resi_pengiriman.tgl_lunas',[$tgl,$tgl0])
            ->paginate(40);
            $dapatoto = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as toto'))
            ->whereBetween('tgl_lunas',[$tgl,$tgl0])
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
            // dd($data);
        $webinfo = DB::table('setting')->limit(1)->get();
            return view('labarugi/laporlabarugi',['tot0'=>$totdat0,'tot'=>$totdat,'data'=>$data,'data0'=>$data0,'title'=>$webinfo,'kate'=>$kate ,'tgl'=>$tgl,'tgl0'=>$tgl0,'ttg'=>$tgll,'dapat'=>$dapat,'totdapat'=>$dapatoto,'kat'=>$kategor]);


        }
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

            // $data0 =DB::table('pengeluaran_lain')
            // ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            // ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            // ->whereYear('pengeluaran_lain.tgl',$tgl)
            // ->groupby('pengeluaran_lain.kategori')
            // ->where([['tb_kategoriakutansi.status','=','pendapatan'],['pengeluaran_lain.kategori','!=','012']])
            // ->paginate(40);
            // dd($data0);
            // foreach ($data0 as $ross) {
            // $total0[] = DB::table('pengeluaran_lain')
            // ->select(DB::raw('SUM(jumlah) as totalnya'))
            // ->whereYear('pengeluaran_lain.tgl',$tgl)
            // ->where('pengeluaran_lain.kategori','=',$ross->kategori)
            // ->get();
            // }
            // $totdat0 = DB::table('pengeluaran_lain')
            // ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            // ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            // ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            // ->whereYear('pengeluaran_lain.tgl',$tgl)
            // ->where([['tb_kategoriakutansi.status','=','pendapatan'],['pengeluaran_lain.kategori','!=','012']])
            // ->get();

            $peng = DB::table('surat_jalan')
            ->select(DB::raw('surat_jalan.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','surat_jalan.katakun')
            ->whereYear('tgl',[$tgl])
            ->paginate(40);
            foreach ($peng as $r) {
            $totalsr[] = DB::table('surat_jalan')
            ->select(DB::raw('SUM(totalcash) as toto'))
            ->where('surat_jalan.id','=',$r->id)
            ->get();
            }
            $pengoto = DB::table('surat_jalan')
            ->select(DB::raw('SUM(totalcash) as toto'))
            ->whereYear('tgl',$tgl)
            ->get();
            $pengpj = DB::table('pajak')
            ->select(DB::raw('pajak.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pajak.katakun')
            ->where('tahun',$tgl)
            ->paginate(40);
            foreach ($pengpj as $ra) {
            $totalpj[] = DB::table('pajak')
            ->select(DB::raw('SUM(total) as toto'))
            ->where('id','=',$ra->id)
            ->get();
            }
            $pengotopj = DB::table('pajak')
            ->select(DB::raw('SUM(total) as toto'))
            ->where('tahun',$tgl)
            ->get();

            $dapatrp = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','resi_pengiriman.katakun')
            ->whereYear('resi_pengiriman.tgl_lunas',$tgl)
            ->paginate(40);
            foreach ($dapatrp as $ras) {
            $totalrp[] = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as toto'))
            ->where('id','=',$ras->id)
            ->get();
            }
            $dapatoto = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as toto'))
            ->whereYear('tgl_lunas',$tgl)
            ->get();
            // dd($data0);
        $webinfo = DB::table('setting')->limit(1)->get();
// return view('labarugi/laporlabarugithn',['tot0'=>$totdat0,'tot'=>$totdat,'data'=>$data,'data0'=>$data0,'title'=>$webinfo,'tgl'=>$tgl,'thn'=>$thn,'toto'=>$total,'toto0'=>$total0, 'surat'=>$peng,'totsurat'=>$totalsr,'totsuratthn'=>$pengoto,'pajak'=>$pengpj,'totpajak'=>$totalpj,'totpajakthn'=>$pengotopj,'resi'=>$dapatrp,'totresi'=>$totalrp,'totresithn'=>$dapatoto]);
return view('labarugi/laporlabarugithn',['tot'=>$totdat,'data'=>$data,'title'=>$webinfo,'tgl'=>$tgl,'thn'=>$thn,'toto'=>$total, 'surat'=>$peng,'totsurat'=>$totalsr,'totsuratthn'=>$pengoto,'pajak'=>$pengpj,'totpajak'=>$totalpj,'totpajakthn'=>$pengotopj,'resi'=>$dapatrp,'totresi'=>$totalrp,'totresithn'=>$dapatoto]);
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

            // $data0 =DB::table('pengeluaran_lain')
            // ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            // ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            // ->whereYear('pengeluaran_lain.tgl',$tgl)
            // ->groupby('pengeluaran_lain.kategori')
            // ->where([['tb_kategoriakutansi.status','=','pendapatan'],['pengeluaran_lain.kategori','!=','012']])
            // ->paginate(40);
            // foreach ($data0 as $ross) {
            // $total0[] = DB::table('pengeluaran_lain')
            // ->select(DB::raw('SUM(jumlah) as totalnya'))
            // ->whereYear('pengeluaran_lain.tgl',$tgl)
            // ->where('pengeluaran_lain.kategori','=',$ross->kategori)
            // ->get();
            // }
            // $totdat0 = DB::table('pengeluaran_lain')
            // ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            // ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            // ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            // ->whereYear('pengeluaran_lain.tgl',$tgl)
            // ->where([['tb_kategoriakutansi.status','=','pendapatan'],['pengeluaran_lain.kategori','!=','012']])
            // ->get();

             $peng = DB::table('surat_jalan')
            ->select(DB::raw('surat_jalan.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','surat_jalan.katakun')
            ->groupby('surat_jalan.katakun')
            ->whereYear('tgl',[$tgl])
            ->paginate(40);
            foreach ($peng as $r) {
            $totalsr[] = DB::table('surat_jalan')
            ->select(DB::raw('SUM(totalcash) as toto'))
            ->where('katakun','=',$r->katakun)
            ->get();
            }
            $pengoto = DB::table('surat_jalan')
            ->select(DB::raw('SUM(totalcash) as toto'))
            ->whereYear('tgl',[$tgl])
            ->whereYear('tgl',$tgl)
            ->get();

            $pengpj = DB::table('pajak')
            ->select(DB::raw('pajak.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pajak.katakun')
            ->groupby('pajak.katakun')
            ->where('tahun','=',$tgl)
            ->paginate(40);
            foreach ($pengpj as $ra) {
            $totalpj[] = DB::table('pajak')
            ->select(DB::raw('SUM(total) as toto'))
            ->where([['tahun',$tgl],['katakun','=',$ra->katakun]])
            ->get();
            }
            $pengotopj = DB::table('pajak')
            ->select(DB::raw('SUM(total) as toto'))
            ->where('tahun',$tgl)
            ->get();

            $dapatrp = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','resi_pengiriman.katakun')
            ->groupby('resi_pengiriman.katakun')
            ->whereYear('resi_pengiriman.tgl_lunas',$tgl)
            ->paginate(40);
            foreach ($dapatrp as $ras) {
            $totalrp[] = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as toto'))
            ->whereYear('tgl_lunas',$tgl)
            ->where('katakun','=',$ras->katakun)
            ->get();
            }
            $dapatoto = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as toto'))
            ->whereYear('tgl_lunas',$tgl)
            ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('labarugi/printlaba',['tot'=>$totdat,'data'=>$data,'title'=>$webinfo,'thn'=>$thn,'toto'=>$total,'surat'=>$peng,'totsurat'=>$totalsr,'totsuratthn'=>$pengoto,'pajak'=>$pengpj,'totpajak'=>$totalpj,'totpajakthn'=>$pengotopj,'resi'=>$dapatrp,'totresi'=>$totalrp,'totresithn'=>$dapatoto]);
    }
}
