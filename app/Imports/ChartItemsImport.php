<?php

namespace App\Imports;

use App\Models\ChartItems;
use Morilog\Jalali\Jalalian;
use Maatwebsite\Excel\Concerns\ToModel;

class ChartItemsImport implements ToModel
{

    public function __construct($report_id)
    {
        $this->report_id = $report_id;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $itemEx = explode('/', $row[1]);
        $date = (new Jalalian($itemEx[0], $itemEx[1], $itemEx[2]))->getTimestamp();

        return new ChartItems([
            'chart_id' => $this->report_id,
            'x_value' => $row[0],
            'y_value' => $date,
        ]);
    }
}
