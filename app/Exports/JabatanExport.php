<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class JabatanExport implements FromCollection, WithHeadings, ShouldAutoSize{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('jabatan')->select('id','jabatan','gaji_pokok','uang_makan')->get();;
    }
    public function headings(): array
    {
        return [
            'Id',
            'Jabatan',
            'Gaji Pokok',
            'Uang Makan',
        ];
    }
    }
