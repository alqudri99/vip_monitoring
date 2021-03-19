<?php

namespace App\Imports;

use App\Hh;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $f = 0;
        $g = array();
        $g["name"] = "Al Qudri";
        Hh::create($g);
        return new Hh([
            'name'     => $row[0]
        ]);
    }
}
