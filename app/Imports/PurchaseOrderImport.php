<?php

namespace App\Imports;

use App\Models\ProductionRequest;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Date;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;
class PurchaseOrderImport implements ToModel, WithStartRow
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
        if (ProductionRequest::where('po_number', $row[2])->exists()) {
            return null; // این ردیف رو رد کن
        }

        if($row[9] === '—' || $row[9] === '-' || $row[9] === null) {
            $atd = null;
        } else {
            $atd= $this->transformDate($row[9]);
        }

        return new ProductionRequest([
            'job_number'       => $row[1] ?? null,
            'po_number'        => $row[2] ?? null,
            'product_name_id'     => Product::where('name', $row[3])->value('id') ?? 0,
            'project_name'     => $row[12] ?? null,
            'customer'         => $row[4] ?? null,
            // 'no_of_structures' => $row['no_of_structures'] ?? null,
            // 'no_of_workers'    => $row['no_of_workers'] ?? null,
            // 'feeders'          => $row['feeders'] ?? null,
            // 'main'             => $row['main'] ?? null,
            // 'tie'              => $row['tie'] ?? null,
            // 'start_date'   => isset($row['start_date']) ? $this->transformDate($row['start_date']) : null,
            // 'end_date'     => isset($row['end_date']) ? $this->transformDate($row['end_date']) : null,
            'request_date' => $this->transformDate($row[7] ?? null),
            'etd'          => $this->transformDate($row[8] ?? null),
            'atd'          => $atd,
        ]);
    }


    protected function transformDate($value)
    {
        if (empty($value) || $value === null) {
            return null;
        }

        // If it's already a date string, return as is
        if (is_string($value) && !is_numeric($value)) {
            return $value;
        }

        // Handle Excel serial date (number of days since 1900-01-01)
        if (is_numeric($value)) {
            // Excel's base date is 1900-01-01 (which is day 1)
            $baseDate = Carbon::create(1899, 12, 30); // Excel considers 1900 as leap year incorrectly
            return $baseDate->addDays($value)->format('Y-m-d');
        }

        return null;
    }
}
