<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Session;
class TrfudaraExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('tarif_udara')
        ->select('kode','tujuan','airlans','perkg','berat_minimal','minimal_heavy','biaya_dokumen','id_cabang')
        ->where('id_cabang',Session::get('cabang'))
        ->get();
        //
    }
    public function headings(): array
    {
        return [
            'kode',
            'tujuan',
            'airlans',
            'tarif_perkg',
            'berat_minimal',
            'minimal_heavy',
            'tarif_dokumen',
            'id cabang'
        ];
    }
}
