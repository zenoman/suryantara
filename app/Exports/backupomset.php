<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class backupomset implements FromCollection, WithHeadings
{
	public function __construct(int $bulan,int $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }
    public function collection()
    {
         return DB::table('omset')
        ->select(DB::raw('bulan,tahun,pemasukan,pengeluaran,pengeluaran_lainya,laba'))
        ->get();    
    }
    public function headings(): array
    {
        return [
            'Bulan',
            'Tahun',
            'Pemasukan',
            'Pengeluaran Vendor',
            'Pengeluaran Lainya',
            'Laba'
        ];
    }
}
