<?php

namespace App\Imports;

use App\Models\LedgerModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Session;

class ClientMasterImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // Skip empty ledger rows
            if (empty($row['ledger_name'])) {
                continue;
            }

            LedgerModel::create([
                'ac_name'       => $row['ledger_name'],
                'ac_short_name' => $row['short_name'] ?? null,
                'group_code'    => $row['group_code'] ?? null,

                'op_bal'        => $row['opening_balance'] ?? 0,
                'op_dc'         => $row['debit_credit'] ?? null,

                'address'       => $row['address'] ?? null,
                'c_id'          => $row['country'] ?? null,
                'state_id'      => $row['state'] ?? null,
                'dist_id'       => $row['district'] ?? null,
                'taluka_id'     => $row['taluka'] ?? null,

                'city_name'     => $row['city'] ?? null,
                'phone'         => $row['phone'] ?? null,
                'mobile'        => $row['mobile'] ?? null,
                'email'         => $row['email'] ?? null,

                'pan_no'        => $row['pan_no'] ?? null,
                'gst_no'        => $row['gst_no'] ?? null,
                'adhar_no'      => $row['adhar_no'] ?? null,

                'bt_id'         => $row['business_type'] ?? null,

                'bank_name'     => $row['bank_name'] ?? null,
                'account_name'  => $row['bank_account_name'] ?? null,
                'account_no'    => $row['account_no'] ?? null,
                'ac_id'         => $row['account_type'] ?? null,
                'ifsc_code'     => $row['ifsc_code'] ?? null,

                'tds_type'      => $row['tds_type'] ?? null,
                'tds_per'       => $row['tds'] ?? null,
                'status_id'     => $row['status'] ?? null,
                'note'          => $row['note'] ?? null,

                'userId'        => Session::get('userId'),
                'delflag'       => 0,
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'ledger_name' => 'required',
        ];
    }
}
