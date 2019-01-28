<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ManualImport implements ToCollection, WithHeadingRow{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows){
    	        //
        foreach ($rows as $row){
            $kode=$row['faktur'];
$dtlam= DB::table('kode_resimanual')->where('faktur',$kode)->count();
if($dtlam > 0){
    // $status = "Maaf Ada Data Yang Sama";
}else{
    	 DB::table('kode_resimanual')->insert([
                    'faktur'=>$row['faktur']
                    ]);
}
        // $status = "Import Sukses";
  }
  // return redirect('tarif_laut')->with('status',$status);
	}
}
