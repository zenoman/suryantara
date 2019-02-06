<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class backuppengeluaranlain implements FromCollection, WithHeadings, ShouldAutoSize
{
	public function __construct(int $bulan,int $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }
    public function collection()
    {
        return DB::table('pengeluaran_lain')
        ->select(DB::raw('tgl,kategori,jumlah,keterangan,admin'))
       	->whereMonth('tgl',$this->bulan)
        ->whereYear('tgl',$this->tahun)
        ->get();
    }
     public function headings(): array
    {
        return [
            'Tanggal',
            'Kategori Pengeluaran',
            'Jumlah',
            'Keterangan',
            'Pembuat'
        ];
    }
}
