<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TraineesTemplateExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Full Name',
            'Gender',
            'Email',
            'Phone Number',
            'ID Number',
            'Age',
            'Level of Computer Literacy',
            'Level of Education',
            'Field of Study',
            'Interests',
        ];
    }
}
