<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanOmsetExport implements FromCollection,WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('omset')
        ->select(DB::raw('bulan,tahun,pemasukan,pengeluaran,gaji_karyawan,pengeluaran_lainya,pajak,laba'))
        ->get();;
    }
    public function headings(): array
    {
        return [
			'bulan',
			'tahun',
			'jumlah pemasukan',
			'jumlah pengeluaran',
            'jumlah pengeluaran gaji karyawan',
			'jumlah pengeluaran lainya',
            'pajak',
			'jumlah laba'
        ];
    }
}
