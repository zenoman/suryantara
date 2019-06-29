<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class LaporanPemasukanExport implements FromCollection,WithHeadings, ShouldAutoSize
{
    public function __construct(string $tgl,string $tgl0,string $jalur)
    {

        $this->tgl = $tgl;
        $this->tgl0 = $tgl0;
        $this->kategori = $kate;
    }

    public function collection(){
        if($this->kategori == 'pendapatan'){
            $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$this->tgl,$this->tgl0])
            ->where('tb_kategoriakutansi.status','=','pendapatan')
            ->groupby('pengeluaran_lain.tgl')
            ->paginate(40);
            // foreach ($data as $ros) {
            //     # code...
            // $total[] = DB::table('pengeluaran_lain')
            // ->select(DB::raw('SUM(jumlah) as totalnya'))
            // ->where('pengeluaran_lain.tgl','=',$ros->tgl)
            // ->get();
            // }
            $totsemua = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$this->tgl,$tthis->gl0])
            ->where('tb_kategoriakutansi.status','=','pendapatan')
            // ->groupby('pengeluaran_lain.tgl')
            ->get();
        }else{
        $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$this->tgl,$this->tgl0])
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            ->groupby('pengeluaran_lain.tgl')
            ->paginate(40);
            // foreach ($data as $ros) {
            //     # code...
            // $total[] = DB::table('pengeluaran_lain')
            // ->select(DB::raw('SUM(jumlah) as totalnya'))
            // ->where([['pengeluaran_lain.tgl','=',$ros->tgl],['kategori','=',$ros->kategori]])
            // ->get();
            
            // } 
            $totsemua = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$this->tgl,$this->tgl0])
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            // ->groupby('pengeluaran_lain.tgl')
            ->get();
        }


    }
    public function headings(): array
    {
        $jlr=$this->jalur;
        if($jlr=='darat' || $jlr =='laut'){
            return [
                'No Resi',
                'Kode Jalan',
                'Total Biaya'
            ];
        }

    }
}