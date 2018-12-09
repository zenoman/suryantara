<?php
namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TrfudaraImport implements ToCollection, WithHeadingRow{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $roww)
    {
        //
        foreach ($roww as $row){
    	 DB::table('tarif_udara')->insert([
                    'kode'=>$row['kode_tujuan'],
                    'tujuan'=>$row['tujuan'],
                    'airlans'=>$row['airlans'],
                    'gencoKG'=>$row['genco_per_kg'],
                    'minimal'=>$row['minimal'],
                    
                    ]);
    	 DB::table('udara_kargo')->insert([
                    'tarif'=>$row['tarif'],
                    'persentase'=>$row['persentase']
                    ]);
    	}
    }
}
