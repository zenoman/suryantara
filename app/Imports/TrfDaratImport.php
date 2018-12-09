<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TrfDaratImport implements ToCollection, WithHeadingRow{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows){
        //
        foreach ($rows as $row){
    	 DB::table('tarif_darat')->insert([
                    'kode'=>$row['kode_tujuan'],
                    'tujuan'=>$row['tujuan'],
                    'tarif'=>$row['tarif'],
                    'berat_min' => $row['berat_minimal'],
                    'estimasi'=> $row['estimasi']
                    ]);
    	}
	}
}

