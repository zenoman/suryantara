<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanPengeluaranLainExport implements FromCollection,WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
        public function __construct(int $bln,int $thn,string $kategori)
    {
        $this->bulan = $bln;
        $this->tahun = $thn;
        $this->kate = $kategori;
    }
    public function collection()
    {
        //
         $kate=$this->kate;
        if($kate !='semua'){
        	return DB::table('pengeluaran_lain')
            ->select(DB::raw('admin,kategori,keterangan,jumlah,tgl'))
            ->whereMonth('tgl',$this->bulan)
            ->whereYear('tgl',$this->tahun)
            ->where('kategori',$this->kate)
            ->get();

        }else{
            return DB::table('pengeluaran_lain')
            ->select(DB::raw('admin,kategori,keterangan,jumlah,tgl'))
            ->whereMonth('tgl',$this->bulan)
            ->whereYear('tgl',$this->tahun)
            ->get();



        }
    }
        public function headings(): array
    {
    		return [
                'admin',
				'kategori',
				'keterangan',
				'jumlah',
				'tgl'
            ];
    }
}

