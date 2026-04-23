<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class EmployeeMasterExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return collect([]); // template only
    }

    public function headings(): array
    {
        return [
            'Employee Name',
            'Contact Number',
            'Address',
            'Particular',
            'Department ID',
            'Employee Group ID',
            'Joining Date',
            'Resigned Date',
        ];
    }
}
