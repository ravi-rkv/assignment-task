<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BulkImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Task([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'mobile' => $row['mobile'],
            'role' => $row['role'],
            'date' => Carbon::createFromFormat('d-m-Y', $row['date'], 'UTC')
                ->setTimezone('Asia/Kolkata')->format('Y-m-d'),
        ]);
    }
}
