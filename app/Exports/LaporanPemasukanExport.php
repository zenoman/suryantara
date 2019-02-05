<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class LaporanPemasukanExport implements FromCollection,WithHeadings, ShouldAutoSize
{
    public function __construct(int $bln,int $thn,string $jalur)
    {
        $this->bulan = $bln;
        $this->tahun = $thn;
        $this->jalur = $jalur;
    }

    public function collection()
    {
        $jlr=$this->jalur;
        if($jlr=='darat' || $jlr =='laut'){
        	return DB::table('resi_pengiriman')
            ->select(DB::raw('no_resi,kode_jalan,admin,nama_pengirim,nama_penerima,telp_pengirim,telp_penerima,pengiriman_via,kota_asal,kode_tujuan,nama_barang,tgl,jumlah,berat,dimensi,ukuran_volume,biaya_kirim,biaya_packing,biaya_asuransi,keterangan,status,satuan,metode_bayar,total_biaya'))
            ->whereMonth('tgl',$this->bulan)
            ->whereYear('tgl',$this->tahun)
            ->where('pengiriman_via',$this->jalur)
            ->get();

        }elseif ($jlr == 'udara') {
            return DB::table('resi_pengiriman')
            ->select(DB::raw('no_resi,no_smu,kode_jalan,admin,nama_pengirim,nama_penerima,telp_pengirim,telp_penerima,pengiriman_via,kota_asal,kode_tujuan,nama_barang,tgl,jumlah,berat,dimensi,ukuran_volume,biaya_kirim,biaya_ppn,biaya_smu,biaya_karantina,biaya_charge,keterangan,status,satuan,metode_bayar,total_biaya'))
            ->whereMonth('tgl',$this->bulan)
            ->whereYear('tgl',$this->tahun)
            ->where('pengiriman_via',$this->jalur)
            ->get();

        }else {
            return DB::table('resi_pengiriman')
            ->select(DB::raw('no_resi,no_smu,kode_jalan,admin,nama_pengirim,nama_penerima,telp_pengirim,telp_penerima,pengiriman_via,kota_asal,kode_tujuan,nama_barang,tgl,jumlah,berat,dimensi,ukuran_volume,biaya_kirim,biaya_packing,biaya_asuransi,biaya_ppn,biaya_smu,biaya_karantina,biaya_charge,keterangan,status,satuan,metode_bayar,total_biaya'))
            ->whereMonth('tgl',$this->bulan)
            ->whereYear('tgl',$this->tahun)
            ->get();
        }
        // dd($data);
    	        //

    }
    public function headings(): array
    {
        $jlr=$this->jalur;
        if($jlr=='darat' || $jlr =='laut'){
            return [
                'No Resi',
                'Kode Jalan',
                'Nama Admin',
                'Nama Pengirim',
                'Nama Penerima',
                'Telp Penerima',
                'Telp Pengirim',
                'Pengiriman Via',
                'Asal',
                'Tujuan',
                'Nama Barang',
                'Tgl Pembuatan Resi',
                'Jumlah',
                'Berat',
                'Dimensi',
                'Ukuran Volume',
                'Biaya Kirim',
                'Biaya Packing',
                'Biaya Asuransi',
                'Keterangan',
                'Status',
                'Satuan',
                'Metode Bayar',
                'Total Biaya'
            ];
        }elseif ($jlr == 'udara') {
            return [
            'No Resi',
            'No SMU',
            'Kode Jalan',
            'Nama Admin',
            'Nama Pengirim',
            'Nama Penerima',
            'Telp Penerima',
            'Telp Pengirim',
            'Pengiriman Via',
            'Asal',
            'Tujuan',
            'Nama Barang',
            'Tgl Pembuatan Resi',
            'Jumlah',
            'Berat',
            'Dimensi',
            'Ukuran Volume',
            'Biaya Kirim',
            'biaya_ppn',
            'biaya_smu',
            'biaya_karantina',
            'biaya_charge',
            'Keterangan',
            'Status',
            'Satuan',
            'Metode Bayar',
            'Total Biaya'
        ];
        }else {
            return [
                'No Resi',
                'No SMU',
                'Kode Jalan',
                'Nama Admin',
                'Nama Pengirim',
                'Nama Penerima',
                'Telp Penerima',
                'Telp Pengirim',
                'Pengiriman Via',
                'Asal',
                'Tujuan',
                'Nama Barang',
                'Tgl Pembuatan Resi',
                'Jumlah',
                'Berat',
                'Dimensi',
                'Ukuran Volume',
                'Biaya Kirim',
                'Biaya Packing',
                'Biaya Asuransi',
                'biaya_ppn',
                'biaya_smu',
                'biaya_karantina',
                'biaya_charge',
                'Keterangan',
                'Status',
                'Satuan',
                'Metode Bayar',
                'Total Biaya'
            ];
        }
    }
}
// no_resi,no_smu,kode_jalan,==admin,nama_barang,pengiriman_via,kota_asal,kode_tujuan,tgl,jumlah,berat,dimensi,ukuran_volume,nama_pengirim,nama_penerima,telp_pengirim,telp_penerima,biaya_kirim,biaya_packing,biaya_asuransi,==,biaya_ppn,biaya_smu,biaya_karantina,total_biaya,keterangan,status,satuan,metode_bayar