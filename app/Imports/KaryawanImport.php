<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KaryawanImport implements ToCollection, WithHeadingRow
{
    
    public function collection(Collection $collection)
    {
        foreach ($collection as $row){
            $kode=$row['kode'];
            $dtlam= DB::table('karyawan')->where('kode',$kode)->count();
            if($dtlam == 0){
                $data[] = [
                    'kode'=>$row['kode'],
                    'nama'=>$row['nama'],
                    'telp'=>$row['telp'],
                    'alamat'=>$row['alamat'],
                    'id_jabatan' => $row['id_jabatan'],
                    'id_cabang'=>$row['id_cabang']
                ];

    	           
               }
        }
        DB::table('karyawan')->insert($data);
	}
}