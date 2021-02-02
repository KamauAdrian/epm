<?php

namespace App\Imports;

use App\Models\Trainee;
use Maatwebsite\Excel\Concerns\ToModel;

class TraineesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Trainee();
    }
}
