<?php

namespace App\Imports;

use App\Models\DetailSelection;
use App\Models\Characteristic;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DetailselectionImport implements ToModel, WithHeadingRow
{
    use Importable;

    private $chars;

    /** constructor for data from controller */

    public function __construct(array $chars =[])
    {
        $this->chars = $chars;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new DetailSelection([
            'tree_name' => $row[0],
            
        ]);
    }
}
