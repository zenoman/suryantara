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
        return DB::table('tarif_udara')->select('kode','tujuan','airlans','perkg','minimal_heavy','biaya_dokumen')->get();;
    }
    public function headings(): array
    {
        return [
            'kode',
            'tujuan',
            'airlans',
            'tarif_perkg',
            'minimal_heavy',
            'tarif_dokumen',
        ];
    }
    }
