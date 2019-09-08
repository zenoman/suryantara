<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class trfcity implements ToCollection, WithHeadingRow{
   public function collection(Collection $rows){
        foreach ($rows as $row){
                 $data[] = [
                    'kode'=>$row['kode_tujuan'],
                    'tujuan'=>$row['tujuan'],
                    'tarif'=>$row['tarif'],
                    'berat_min' => $row['berat_minimal'],
                    'estimasi'=> $row['estimasi'],
                    'id_cabang'=>$row['id_cabang'],
                    'tarif_city'=>'Y',
                    'company'=>$row['company']
                ];
        }
         DB::table('tarif_darat')->insert($data);
	}
}

