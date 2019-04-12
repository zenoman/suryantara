<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class backuppengeluaran implements FromCollection, WithHeadings
{
	public function __construct(int $bulan,int $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }
    public function collection()
    {
        return DB::table('resi_pengiriman')
            ->select(DB::raw('surat_jalan.kode,resi_pengiriman.no_resi,surat_jalan.tujuan,resi_pengiriman.tgl_bayar,resi_pengiriman.biaya_suratjalan'))
            ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
            ->whereMonth('resi_pengiriman.tgl_bayar',$this->bulan)
            ->whereYear('resi_pengiriman.tgl_bayar',$this->tahun)
            ->where('resi_pengiriman.tgl_bayar','!=',null)
            ->get();
    }
    public function headings(): array
    {
        return [
            'kode','resi','tujuan','tgl_bayar','biaya'
        ];
    }
}
