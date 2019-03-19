<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KaryawanExport implements FromCollection, WithHeadings, ShouldAutoSize{
    public function collection()
    {
        return DB::table('karyawan')
        ->select(DB::raw('karyawan.id,karyawan.kode,karyawan.nama,karyawan.telp,karyawan.alamat,jabatan.jabatan'))
        ->leftjoin('jabatan','jabatan.id','=','karyawan.id_jabatan')
        ->get();;
    }
    public function headings(): array
    {
        return [
            'Id',
            'Id Karyawan',
            'Nama Karyawan',
            'telp ',
            'Alamat',
            'Jabatan',
        ];
    }
    }