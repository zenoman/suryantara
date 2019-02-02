<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KaryawanExport implements FromCollection, WithHeadings, ShouldAutoSize{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('karyawan')->select('kode','nama','telp','alamat','id_jabatan')->get();;
    }
    public function headings(): array
    {
        return [
            'Kode Karyawan',
            'Nama Karyawan',
            'telp ',
            'Alamat',
            'Id Jabatan',
        ];
    }
    }