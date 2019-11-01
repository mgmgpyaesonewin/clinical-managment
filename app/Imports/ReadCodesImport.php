<?php

namespace App\Imports;

use App\ReadCode;
use Maatwebsite\Excel\Concerns\ToModel;

class ReadCodesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ReadCode([
            'code' => $row[0],
            'block_id' => $row[1],
            'title' => $row[2],
            'class_kind' => $row[3],
            'depth_in_kind' => $row[4],
            'is_residual' => $row[5],
            'primary_location' => $row[6],
            'chapter_no' => $row[7],
            'browser_link' => $row[8],
            'is_leaf' => $row[9],
            'no_of_non_residual_children' => $row[10],
        ]);
    }
}
