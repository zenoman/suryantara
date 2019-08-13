<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
        $data[] = [ 
            'no_resi'=>$row['no_resi'],
            'pemegang'=>$row['id_karyawan'],
            'metode_input'=>'manual',
            'id_cabang'=>Session::get('cabang')
        ]; 
    	 
            }
        }
        DB::table('resi_pengiriman')
         ->insert($data);
  }
}
