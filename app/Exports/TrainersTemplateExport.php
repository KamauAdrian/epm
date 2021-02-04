<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TrainersTemplateExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return [];
    }
    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'Full Name',
            'Employee Number',
            'Email',
            'Phone Number',
            'Gender',
            'County',
        ];
    }
}
