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
            $kode=$row['id_vendor'];
            // dd($kode);
$dtlam= DB::table('vendor')->where('idvendor',$kode)->count();
if($dtlam > 0){
        // $status = "Maaf Ada Data Yang Sama";
}else{
    	 DB::table('vendor')->insert([
                    'idvendor'=>$row['id_vendor'],
                    'vendor'=>$row['nama_vendor'],
                    'telp'=>$row['telp'],
                    'alamat' => $row['alamat'],
                    'cabang' => $row['cabang']
                    ]);
    	}
      }
    }
}
