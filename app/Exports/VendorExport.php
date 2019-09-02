<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class VendorExport implements FromCollection, WithHeadings, ShouldAutoSize{
    
    public function collection()
    {
    return DB::table('vendor')->select('idvendor','vendor','telp','alamat','id_cabang')->get();;
    }
    public function headings(): array
    {
        return [
            'id_vendor',
            'nama_vendor',
            'telp',
            'alamat',
            'id_cabang'
        ];
    }
}
