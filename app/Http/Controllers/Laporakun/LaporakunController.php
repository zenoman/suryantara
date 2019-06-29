<?php
namespace App\Http\Controllers\Laporakun;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Laporakunmodel;

use App\Exports\LaporakunExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\File;
class LaporakunController extends Controller
{

    public function pilihlapkun()
    {
        $setting = DB::table('setting')->get();
        
        return view('laporakun/pilihlapkun',['title'=>$setting]);
    }

    public function tampilakunlapor(Request $request){
        $rules = [
            'tgl' => 'required',
            'tgl0' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);
        $kate=$request->kategori;
        $tgl = $request->tgl;
        $tgl0 = $request->tgl0;

        if($kate=='pendapatan'){
            $kat = 'pendapatan';
            $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pendapatan')
            ->groupby('pengeluaran_lain.tgl')
            ->paginate(40);
            foreach ($data as $ros) {
                # code...
            $total[] = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->where('pengeluaran_lain.tgl','=',$ros->tgl)
            ->get();
            }
            $totsemua = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pendapatan')
            // ->groupby('pengeluaran_lain.tgl')
            ->get();
        }else{
        $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            ->groupby('pengeluaran_lain.tgl')
            ->paginate(40);
            foreach ($data as $ros) {
                # code...
            $total[] = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->where([['pengeluaran_lain.tgl','=',$ros->tgl],['kategori','=',$ros->kategori]])
            ->get();
            
            } 
            $totsemua = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            // ->groupby('pengeluaran_lain.tgl')
            ->get();
        }

        // dd($total);
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('laporakun/laporharianakun',['kat'=>$kate ,'tgl'=>$tgl,'tgl0'=>$tgl0,'tose'=>$totsemua,'tot'=>$total,'data'=>$data,'title'=>$webinfo]);
    }

        public function exsportabsensibulanan($kat,$tgl,$tgl0){

            $namafile = "Export laporan ".$kat." tanggal ".$tgl." sampai ".$tgl0." .xlsx";
        return Excel::download(new LaporakunExport($kat,$tgl,$tgl0),$namafile);
    }

        public function cetaklapakun($kat,$tgl,$tgl0){
        if($kat=='pendapatan'){
            $kat = 'pendapatan';
            $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pendapatan')
            ->groupby('pengeluaran_lain.tgl')
            ->paginate(40);
            foreach ($data as $ros) {
                # code...
            $total[] = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->where('pengeluaran_lain.tgl','=',$ros->tgl)
            ->get();
            }
            $totsemua = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pendapatan')
            // ->groupby('pengeluaran_lain.tgl')
            ->get();
        }else{
        $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            ->groupby('pengeluaran_lain.tgl')
            ->paginate(40);
            foreach ($data as $ros) {
                # code...
            $total[] = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->where([['pengeluaran_lain.tgl','=',$ros->tgl],['kategori','=',$ros->kategori]])
            ->get();
            
            } 
            $totsemua = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            // ->groupby('pengeluaran_lain.tgl')
            ->get();
        }
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('laporakun/cetaklapakun',['kat'=>$kat ,'tgl'=>$tgl,'tgl0'=>$tgl0,'tose'=>$totsemua,'tot'=>$total,'data'=>$data,'title'=>$webinfo
    ]);
    }





}
