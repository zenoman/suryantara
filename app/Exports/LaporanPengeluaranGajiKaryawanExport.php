<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanPengeluaranGajiKaryawanExport implements FromCollection,WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(int $bln,int $thn,string $jabatan)
    {
        $this->bulan = $bln;
        $this->tahun = $thn;
        $this->vdr = $jabatan;
    }
    public function collection()
    {
        $vdr=$this->vdr;
        if($vdr != 'semua'){
            return DB::table('gaji_karyawan')
            ->select(DB::raw('kode_karyawan,nama_karyawan,id_jabatan,tgl,gaji_pokok,uang_makan'))
            ->whereMonth('tgl',$this->bulan)
            ->whereYear('tgl',$this->tahun)
            ->where('id_jabatan',$this->vdr)
            ->get();;
        }else{
            return DB::table('gaji_karyawan')
            ->select(DB::raw('kode_karyawan,nama_karyawan,id_jabatan,tgl,gaji_pokok,uang_makan'))
            ->whereMonth('tgl',$this->bulan)
            ->whereYear('tgl',$this->tahun)
            ->get();;
        }
        //
    }
        public function headings(): array
    {
        return [
            'kode_karyawan','nama_karyawan','id_jabatan','tgl','gaji_pokok','uang_makan',
        ];
    }
}
