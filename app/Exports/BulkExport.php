<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BulkExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Task::all([
            'name', 'email', 'mobile', 'role', 'date'
        ]);
    }

    public function headings(): array
    {
        return [
            'Name', 'Email', 'Mobile', 'Role', 'Date'
        ];
    }
}
