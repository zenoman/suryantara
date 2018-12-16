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
            $kode=$row['kode_tujuan'];
$dtlam= DB::table('tarif_udara')->where('kode',$kode)->count();
if($dtlam > 0){
    // $status = "Maaf Ada Data Yang Sama";
}else{
    	 DB::table('tarif_udara')->insert([
                    'kode'=>$row['kode_tujuan'],
                    'tujuan'=>$row['tujuan'],
                    'airlans'=>$row['airlans'],
                    'gencoKG'=>$row['genco_per_kg'],
                    'minimal'=>$row['minimal'],
                    
                    ]);
    	 DB::table('udara_kargo')->insert([
                    'kode_udara'=>$row['kode_tujuan'],
                    'tarif'=>$row['tarif'],
                    'persentase'=>$row['persentase']
                    ]);
    	}
        // $status = "Import Sukses";
  }
  // return redirect('tarif_laut')->with('status',$status);
    }
}
