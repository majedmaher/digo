<?php

namespace App\Imports;

use App\Models\Email;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmailImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['email']) {
            return new Email([
                'email' => trim($row['email']),
            ]);
        }
    }
}
