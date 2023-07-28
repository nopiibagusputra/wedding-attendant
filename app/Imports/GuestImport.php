<?php

namespace App\Imports;

use App\Models\GuestModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GuestImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new GuestModel([
            'nama' => $row[0],
            'alamat' => $row[1],
            'kode_guest' => mt_rand(10000000, 99999999),
            'status'=> 0,
        ]);
    }
}
