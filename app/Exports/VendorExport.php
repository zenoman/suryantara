<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VendorExport implements FromCollection, WithHeadings{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
                return DB::table('vendor')->select('idvendor','vendor','telp','alamat')->get();;
    }
    public function headings(): array
    {
        return [
            'id_vendor',
            'nama_vendor',
            'telp',
            'alamat',
        ];
    }
}
