<?php
namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\DB;
<<<<<<< HEAD
>>>>>>> parent of 8d4d6fc... Merge branch 'master' of https://github.com/zenoman/suryantara
=======
>>>>>>> parent of 8f1a224... titik lengkap iki
=======
>>>>>>> parent of e0fcee6... Merge branch 'master' of https://github.com/zenoman/suryantara
=======
>>>>>>> parent of abc5835... import export

class Trf_lautImport implements ToCollection, WithHeadingRow{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collec)
    {
    	// dd($collec);
        foreach ($collec as $row){
    	 DB::table('tarif_laut')->insert([
                    'kode'=>$row['kode_tujuan'],
                    'tujuan'=>$row['tujuan'],
                    'tarif'=>$row['tarif'],
                    'berat_min' => $row['berat_minimal'],
                    'estimasi'=> $row['estimasi']
                    ]);
    	}
    }
}
