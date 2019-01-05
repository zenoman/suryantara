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
        return DB::table('surat_jalan')
        ->select(DB::raw('tgl,kode,tujuan,totalkg,totalkoli,totalcash,totalbt,biaya,alamat_tujuan,admin'))
       	->whereMonth('tgl',$this->bulan)
        ->whereYear('tgl',$this->tahun)
        ->get();
    }
    public function headings(): array
    {
        return [
            'Tanggal',
            'Nomor surat jalan',
            'Tujuan',
            'Total berat(kg)',
            'Total jumlah(koli)',
            'Total Cash',
            'Total BT',
            'Biaya',
            'Alamat tujuan',
            'Pembuat'
        ];
    }
}
