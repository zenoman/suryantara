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
                    'perkg'=>$row['tarif_perkg'],
                    'minimal_heavy'=>$row['minimal_heavy'],
                    'biaya_dokumen'=>$row['tarif_dokumen'],
                    
                    ]);
    	}

    }
}
