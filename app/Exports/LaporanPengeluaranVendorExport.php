<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanPengeluaranVendorExport implements FromCollection,WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
        public function __construct(int $bln,int $thn,string $vendor)
    {
        $this->bulan = $bln;
        $this->tahun = $thn;
        $this->vdr = $vendor;
    }

    public function collection()
    {
        $vdr=$this->vdr;
        if($vdr != 'semua'){
            return DB::table('surat_jalan')
            ->select(DB::raw('admin,kode,tujuan,tgl,status,totalkg,totalkoli,totalcash,totalbt,biaya,alamat_tujuan'))
            ->whereMonth('tgl',$this->bulan)
            ->whereYear('tgl',$this->tahun)
            ->where('tujuan',$this->vdr)
            ->get();;
        }else{
            return DB::table('surat_jalan')
            ->select(DB::raw('admin,kode,tujuan,tgl,status,totalkg,totalkoli,totalcash,totalbt,biaya,alamat_tujuan'))
            ->whereMonth('tgl',$this->bulan)
            ->whereYear('tgl',$this->tahun)
            ->get();;
        }
        //
    }
        public function headings(): array
    {
        return [
            'admin','kode','tujuan','tgl','status','totalkg','totalkoli','totalcash','totalbt','biaya','alamat_tujuan',
        ];
    }
}