<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanPengeluaranVendorhariExport implements FromCollection,WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
        public function __construct(int $tgl,int $bln,int $thn,string $vendor)
    {
        $this->tanggal = $tgl;
        $this->bulan = $bln;
        $this->tahun = $thn;
        $this->vdr = $vendor;
    }

    public function collection()
    {
        $vdr=$this->vdr;
        if($vdr != 'semua'){
            return DB::table('resi_pengiriman')
            ->select(DB::raw('surat_jalan.kode,resi_pengiriman.no_resi,surat_jalan.tujuan,resi_pengiriman.tgl_bayar,resi_pengiriman.biaya_suratjalan'))
            ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
            ->whereDay('surat_jalan.tgl_bayar',$this->tanggal)
            ->whereMonth('resi_pengiriman.tgl_bayar',$this->bulan)
            ->whereYear('resi_pengiriman.tgl_bayar',$this->tahun)
            ->where([['surat_jalan.tujuan',$this->vdr],['resi_pengiriman.tgl_bayar','!=',null]])
            ->get();
        }else{
            return DB::table('resi_pengiriman')
            ->select(DB::raw('surat_jalan.kode,resi_pengiriman.no_resi,surat_jalan.tujuan,resi_pengiriman.tgl_bayar,resi_pengiriman.biaya_suratjalan'))
            ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
            ->whereDay('surat_jalan.tgl_bayar',$this->tanggal)
            ->whereMonth('resi_pengiriman.tgl_bayar',$this->bulan)
            ->whereYear('resi_pengiriman.tgl_bayar',$this->tahun)
            ->where('resi_pengiriman.tgl_bayar','!=',null)
            ->get();
        }

        //
    }
        public function headings(): array
    {
        return [
            'kode','resi','tujuan','tgl_bayar','biaya'
        ];
    }
}