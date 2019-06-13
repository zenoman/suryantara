<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
class backupendapatan implements FromCollection, WithHeadings
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
        ->select(DB::raw('tgl,no_resi,no_smu,kode_jalan,admin,nama_barang,pengiriman_via,kota_asal,kode_tujuan,jumlah,berat,dimensi,ukuran_volume,nama_pengirim,telp_pengirim,nama_penerima,telp_penerima,biaya_kirim,biaya_packing,biaya_asuransi,biaya_smu,biaya_karantina,biaya_ppn,total_biaya,metode_bayar,satuan,keterangan'))
        ->whereMonth('tgl_lunas',$this->bulan)
        ->whereYear('tgl_lunas',$this->tahun)
        ->get();
        
    }

     public function headings(): array
    {
        return [
            'tanggal',
            'nomor resi',
            'nomor smu',
            'nomor surat jalan',
            'pembuat',
            'isi paket',
            'jalur pengiriman',
            'kota asal',
            'kota tujuan',
            'jumlah',
            'berat (kg)',
            'dimensi (PxLxT)',
            'volumetrik',
            'pengirim',
            'telp. pengirim',
            'penerima',
            'telp. penerima',
            'biaya kirim',
            'biaya packing',
            'biaya asuransi',
            'biaya SMU',
            'biaya karantina',
            'biaya ppn',
            'total biaya',
            'metode bayar',
            'acuan bayar',
            'keterangan'
        ];
    }
}
