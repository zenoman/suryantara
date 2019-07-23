<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class cabangexport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('cabang')->select('id','nama','alamat')->get();
    }
     public function headings(): array
    {
        return [
            'Kode Cabang',
            'nama Cabang',
            'alamat'
        ];
    }
}
