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
        // return DB::table('tarif_udara')->select('kode','tujuan','airlans','gencoKG','minimal')->JOIN()->get();;
        // return DB::table('udara_kargo')->select('tarif','persentase')->where('kode_udara',$kode)->get();;
return  DB::table('tarif_udara')
->join('udara_kargo', 'udara_kargo.kode_udara', '=', 'tarif_udara.kode')
->select('udara_kargo.tarif_perkg','udara_kargo.tarif_dokumen','udara_kargo.persentase','tarif_udara.kode','tarif_udara.tujuan','tarif_udara.airlans','tarif_udara.perkg')->get();;
    }
    public function headings(): array
    {
        return [
            'kode','tujuan','airlans','berat_perkg','tarif_perkg','tarif_dokumen','persentase',
        ];
}
}
