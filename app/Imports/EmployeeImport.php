<?php

namespace App\Imports;

use App\Models\EmployeeModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Session;

class EmployeeImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $firm_id = Session::get('firm_id') ?? 1;

        DB::transaction(function () use ($rows, $firm_id) {

            // 🔒 Lock counter ONCE for entire import
            $counter = DB::table('counter_number')
                ->where('c_name', 'C1')
                ->where('type', 'w_no')
                ->where('firm_id', $firm_id)
                ->lockForUpdate()
                ->first();

            if (!$counter) {
                throw new \Exception('Employee counter not found');
            }

            $nextNo = $counter->tr_no;

            foreach ($rows as $index => $row) {

                // Skip header row
                if ($index === 0) {
                    continue;
                }

                if (empty($row[0])) {
                    continue;
                }

                $nextNo++;
                $w_no = $counter->code . $nextNo; // SE1, SE2, SE3...

                Log::info('Employee Import Row', $row->toArray());

                EmployeeModel::create([
                    'w_no'          => $w_no,
                    'w_name'        => trim($row[0]),
                    'w_contact'     => $row[1] ?? null,
                    'w_address'     => $row[2] ?? null,
                    'w_particular'  => $row[3] ?? null,
                    'dept_id'       => $row[4] ?? null,
                    'egroup_id'     => $row[5] ?? null,
                    'joiningDate'   => $this->formatDate($row[6] ?? null),
                    'resignedDate'  => $this->formatDate($row[7] ?? null),
                    'delflag'       => 0,
                    'firm_id'       => $firm_id,
                ]);
            }

            // 🔁 Update counter AFTER full import
            DB::table('counter_number')
                ->where('c_name', 'C1')
                ->where('type', 'w_no')
                ->where('firm_id', $firm_id)
                ->update(['tr_no' => $nextNo]);
        });
    }

    private function formatDate($value)
    {
        if (!$value) {
            return null;
        }

        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value)->format('Y-m-d');
        }

        return date('Y-m-d', strtotime($value));
    }
}
