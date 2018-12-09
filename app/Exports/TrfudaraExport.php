<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TrfudaraExport implements FromCollection, WithHeadings{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
       {
        return DB::table('udara_udara')->select('kode','tujuan','airlans','gencoKG','minimal,')->get();;
        return DB::table('udara_kargo')->select('tarif','persentase')->get();;
    }
    public function headings(): array
    {
        return [
            'kode','tujuan','airlans','gencoKG','minimal','tarif','persentase',
        ];
}
