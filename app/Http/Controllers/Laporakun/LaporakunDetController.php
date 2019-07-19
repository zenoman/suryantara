<?php
namespace App\Http\Controllers\Laporakun;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Laporakudetnmodel;

use App\Exports\AbsensiharianExport;
use App\Exports\AbsensibulananExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\File;
class LaporakunDetController extends Controller
{

    public function pilihlapkun()
    {
        $setting = DB::table('setting')->get();
        $kategori = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama,tb_kategoriakutansi.kode'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->groupby('pengeluaran_lain.kategori')
            ->get();
        
        return view('laporakun/pilihlapkundet',['title'=>$setting,'kate'=>$kategori]);
    }

    public function tampilakunlapor(Request $request){
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

            $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('pengeluaran_lain.kategori','=',$kate)
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
            ->where('pengeluaran_lain.kategori','=',$kate)
            ->get();
        

        // dd($data);
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('laporakun/laporharianakundet',['kate'=>$kate ,'tgl'=>$tgl,'tgl0'=>$tgl0,'tose'=>$totsemua,'tot'=>$total,'data'=>$data,'title'=>$webinfo]);
    }

        public function exsportabsensibulanan($tanggal, $jabatan){

            $namafile = "Export absensi bulanan pada bulan ".$tanggal.".xlsx";
        return Excel::download(new AbsensibulananExport($tanggal,$jabatan),$namafile);
    }

        public function cetaklapakundet($kate,$tgl,$tgl0){
        $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('pengeluaran_lain.kategori','=',$kate)
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
            ->where('pengeluaran_lain.kategori','=',$kate)
            ->get();
            $katkat = DB::table('tb_kategoriakutansi')
            ->select(DB::raw('nama'))
            ->where('kode','=',$kate)
            ->get();

        $webinfo = DB::table('setting')->limit(1)->get();
    return view('laporakun/cetaklapakundet',['kat'=>$katkat ,'tgl'=>$tgl,'tgl0'=>$tgl0,'tose'=>$totsemua,'tot'=>$total,'data'=>$data,'title'=>$webinfo
    ]);
    }





}