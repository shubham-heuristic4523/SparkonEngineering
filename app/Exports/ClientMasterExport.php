<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

// class ClientMasterExport implements FromCollection, WithHeadings
// {
//     public function collection()
//     {
//         return collect([]); // only headings
//     }

//     public function headings(): array
//     {
//         return [
//             'Account Name',
//             'Short Name',
//             'Group Code',
//             'Opening Balance',
//             'Debit/Credit',
//             'Address',
//             'Country',
//             'State',
//             'District',
//             'Taluka',
//             'City',
//             'Phone',
//             'Mobile',
//             'Email',
//             'PAN No',
//             'GST No',
//             'Adhar No',
//             'Business Type',
//             'Bank Name',
//             'Bank Account Name',
//             'Account No',
//             'Account Type',
//             'IFSC Code',
//             'TDS Type',
//             'TDS %',
//             'Status',
//             'Note',
//         ];
//     }
// }


class ClientMasterExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'Ledger Name',          // ✅ renamed
            'Short Name',
            'Group Code',
            'Opening Balance',
            'Debit/Credit',
            'Address',
            'Country',
            'State',
            'District',
            'Taluka',
            'City',
            'Phone',
            'Mobile',
            'Email',
            'PAN No',
            'GST No',
            'Adhar No',
            'Business Type',
            'Bank Name',
            'Bank Account Name',
            'Account No',
            'Account Type',
            'IFSC Code',
            'TDS Type',
            'TDS %',
            'Status',
            'Note',
        ];
    }
}
