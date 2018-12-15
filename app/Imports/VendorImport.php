<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class VendorImport implements ToCollection, WithHeadingRow{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collec){
        foreach ($collec as $row){
    	 DB::table('vendor')->insert([
                    'idvendor'=>$row['id_vendor'],
                    'vendor'=>$row['nama_vendor'],
                    'telp'=>$row['telp'],
                    'alamat' => $row['alamat']
                    ]);
    	}
    }
}
