<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KaryawanExport implements FromCollection, WithHeadings, ShouldAutoSize{
    public function collection()
    {
        return DB::table('karyawan')
        ->select(DB::raw('karyawan.id,karyawan.kode,karyawan.nama,karyawan.telp,karyawan.alamat,jabatan.jabatan,karyawan.id_cabang'))
        ->leftjoin('jabatan','jabatan.id','=','karyawan.id_jabatan')
        ->where('karyawan.id_cabang','=',Session::get('cabang'))
        ->get();
    }
    public function headings(): array
    {
        return [
            'Id',
            'Id Karyawan',
            'Nama Karyawan',
            'Telp',
            'Alamat',
            'Jabatan',
            'Kode cabang'
        ];
    }
    }