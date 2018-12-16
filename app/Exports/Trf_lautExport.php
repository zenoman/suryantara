<?php
 
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Trf_lautExport implements FromCollection, WithHeadings{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
                return DB::table('tarif_laut')->select('kode','tujuan','tarif','berat_min','estimasi')->get();;
    }
    public function headings(): array
    {
        return [
            'Kode Tujuan',
            'Tujuan',
            'Tarif Laut',
            'Berat Minimal',
            'estimasi',
        ];
    }
}
