<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Concerns\WithValidation;

class Trf_lautImport implements ToCollection, WithHeadingRow{
    /**
    * @param Collection $collection
    */
    // use Importable;
    
    public function collection(Collection $collec)
    {
        foreach ($collec as $row){
            $kode=$row['kode_tujuan'];
            // dd($kode);
$dtlam= DB::table('tarif_laut')->where('kode',$kode)->count();
if($dtlam > 0){
        // $status = "Maaf Ada Data Yang Sama";
}else{
    	 DB::table('tarif_laut')->insert([
                    'kode'=>$row['kode_tujuan'],
                    'tujuan'=>$row['tujuan'],
                    'tarif'=>$row['tarif'],
                    'berat_min' => $row['berat_minimal'],
                    'estimasi'=> $row['estimasi']
                    ]);
    	}
        // $status = "Import Sukses";
  }
  // return $status;
  // return redirect('tarif_laut')->with('status',$status);
    }
}