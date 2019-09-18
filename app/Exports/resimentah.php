<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Session;

class resimentah implements FromCollection, WithHeadings, ShouldAutoSize
{
    
    public function collection(){
        return DB::table('resi_mentah')
        ->select('no_resi')
        ->where('id_cabang',Session::get('cabang'))
        ->get();
    }
    

    public function headings(): array{
        return [
            'Nomor Resi',
        ];
    }
}
