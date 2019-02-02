<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KaryawanExport implements FromCollection, WithHeadings, ShouldAutoSize{
    public function collection()
    {
        return DB::table('karyawan')->select('id','kode','nama','telp','alamat','id_jabatan')->get();;
    }
    public function headings(): array
    {
        return [
            'id karyawan',
            'Kode Karyawan',
            'Nama Karyawan',
            'telp ',
            'Alamat',
            'Id Jabatan',
        ];
    }
    }