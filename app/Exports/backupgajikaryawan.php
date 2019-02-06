<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class backupgajikaryawan implements FromCollection,WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function __construct(int $bln,int $thn)
    {
        $this->bulan = $bln;
        $this->tahun = $thn;
    }
    public function collection()
    {
            return DB::table('gaji_karyawan')
            ->select(DB::raw('
                gaji_karyawan.kode_karyawan,
                gaji_karyawan.nama_karyawan,
                jabatan.jabatan,
                gaji_karyawan.gaji_pokok,
                gaji_karyawan.uang_makan,
                gaji_karyawan.gaji_tambahan,
                gaji_karyawan.total'))
            ->join('jabatan','jabatan.id','=','gaji_karyawan.id_jabatan')
            ->where([
                ['gaji_karyawan.bulan','=',$this->bulan],
                ['gaji_karyawan.tahun','=',$this->tahun]])
            ->get();;
    }
        public function headings(): array
    {
        return [
            'kode_karyawan',
            'nama_karyawan',
            'jabatan',
            'gaji_pokok',
            'uang_makan',
            'tambahan',
            'total'
        ];
    }
}
