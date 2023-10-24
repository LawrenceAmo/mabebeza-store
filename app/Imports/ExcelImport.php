<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToArray;

class ExcelImport implements ToArray
{
    /**
    * @param Collection $collection
    */
    // public function collection(Collection $collection)
    // {
    //     return $collection;
    // }

    public function array(array $rows)
    {
       return $rows[0];
    }
}
 