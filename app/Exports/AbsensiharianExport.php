<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsensiharianExport implements FromCollection,WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
        public function __construct(string $tanggal,string $jabatan)
    {
        $this->tgl = $tanggal;
        $this->jbt = $jabatan;
    }
    public function collection()
    {
        $jbt=$this->jbt;
        if($jbt != 'semua'){
            return DB::table('absensi')
            ->select(DB::raw('karyawan.kode,karyawan.nama,jabatan.jabatan,absensi.tanggal,absensi.masuk,absensi.tidak_masuk,absensi.izin,absensi.keterangan_izin'))
            ->join('jabatan','jabatan.id','=','absensi.id_jabatan')
            ->join('karyawan','karyawan.id','=','absensi.id_karyawan')
            ->where([['absensi.tanggal','=',$this->tgl],['absensi.id_jabatan','=',$this->jbt]])
            ->get();
        }else{
            return DB::table('absensi')
            ->select(DB::raw('karyawan.kode,karyawan.nama,jabatan.jabatan,absensi.tanggal,absensi.masuk,absensi.tidak_masuk,absensi.izin,absensi.keterangan_izin'))
            ->join('jabatan','jabatan.id','=','absensi.id_jabatan')
            ->join('karyawan','karyawan.id','=','absensi.id_karyawan')
            ->where([['absensi.tanggal','=',$this->tgl]])
            ->get();
        }
    }
        public function headings(): array
    {
        return [
            'kode',
            'nama',
            'jabatan',
            'tanggal',
            'masuk',
            'tidak_masuk',
            'izin',
            'keterangan_izin'
        ];
    }
}
