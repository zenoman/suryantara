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
        $kode=$row['no_resi'];
        
        $dtlam = DB::table('resi_pengiriman')
        ->where('no_resi',$kode)->count();
        
        if($dtlam == 0){ 
    	 DB::table('resi_pengiriman')
         ->insert([
            'no_resi'=>$row['no_resi'],
            'pemegang'=>$row['id_karyawan'],
            'metode_input'=>'manual'
            ]);
        }
  }
  }
}
