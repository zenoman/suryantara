<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class distribusiresiImport implements ToCollection, WithHeadingRow{
   
    public function collection(Collection $rows){
        $kodenya = '';
        foreach ($rows as $row){
        $data[] = [ 
            'no_resi'=>$row['no_resi'],
            'id_cabang'=>$row['kode_cabang'],
            'pembuat'=>Session::get('username')
        ]; 
        }
        
        DB::table('resi_mentah')
         ->insert($data);
  }
}
