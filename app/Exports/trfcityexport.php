<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Session;
class trfcityexport implements FromCollection, WithHeadings, ShouldAutoSize{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('tarif_darat')
        ->select('kode','tujuan','tarif','berat_min','estimasi','id_cabang','company')
        ->where([['tarif_city','Y'],['id_cabang',Session::get('cabang')]])
        ->get();
    }
    public function headings(): array
    {
        return [
            'Kode Tujuan',
            'Tujuan',
            'Tarif Darat',
            'Berat Minimal',
            'estimasi',
            'id cabang',
            'company'
        ];
    }
    }
