<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class Trf_lautImport implements ToCollection, WithHeadingRow{
    public function collection(Collection $collec)
    {
        foreach ($collec as $row){
        $kode=$row['kode_tujuan'];
        $dtlam= DB::table('tarif_laut')->where('kode',$kode)->count();
        if($dtlam == 0){
                    $data[] = [
                    'kode'=>$row['kode_tujuan'],
                    'tujuan'=>$row['tujuan'],
                    'tarif'=>$row['tarif'],
                    'berat_min' => $row['berat_minimal'],
                    'estimasi'=> $row['estimasi'],
                    'id_cabang'=>$row['id_cabang']
                    ];
                   
            }
        }
         DB::table('tarif_laut')->insert($data);
    }
}
