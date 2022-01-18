<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportProducts implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'cat_id'     => @$row[0],
            'product_name'    => @$row[1], 
            'product_image'    => @$row[2]
        ]);
    }
}
