<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
class backupendapatan implements FromCollection
{
	public function __construct(int $bulan,int $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('resi_pengiriman')
        ->whereMonth('tgl',$this->bulan)
        ->whereYear('tgl',$this->tahun)
        ->get();
        
    }
}
