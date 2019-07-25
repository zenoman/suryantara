<?php
 
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class Trf_lautExport implements FromCollection, WithHeadings, ShouldAutoSize{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
                return DB::table('tarif_laut')->select('kode','tujuan','tarif','berat_min','estimasi','id_cabang')->get();;
    }
    public function headings(): array
    {
        return [
            'Kode Tujuan',
            'Tujuan',
            'Tarif Laut',
            'Berat Minimal',
            'estimasi',
            'id cabang'
        ];
    }
}
