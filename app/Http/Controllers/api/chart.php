<?php

namespace App\Http\Controllers\api;

use App\Libs\HelpFunction;
use App\Models\ChartCategories;
use App\Models\Charts;
use App\Models\Clients;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class chart extends MyController
{
    public $successStatus = 200;
    protected $ChartCategories;
    protected $Charts;
    protected $Clients;

    function __construct(ChartCategories $ChartCategories, Charts $Charts, Clients $Clients)
    {
        $this->ChartCategories = $ChartCategories;
        $this->Charts = $Charts;
        $this->Clients = $Clients;
    }

    public function chartItems(Request $request)
    {

        /** @var int $responseCode */
        /** @var array $data */
        /** @var array $message */
        /** @var int $status */
        /** @var User $user */

        $ChartsSelect = $this->Charts->where('id', $request->id)
            ->first();

        $ClienSelectSelect = $this->Clients->where('phone', $request->phone)
            ->first();

        if ($ClienSelectSelect) {
            if (!Hash::check($request->password, $ClienSelectSelect->password)) {
                $status = '120';
                $message = 'Wrong password';
                return response()->json(['status' => $status, 'message' => $message]);
            } else {
                if ($request->_type) {
                    $_type = $request->_type;
                    if ($_type == 'column' || $_type == 'line') {
                        $status = '200';
                        $message = 'OK';
                        $from_date = $request->from_date;
                        $to_date = $request->to_date;
                        return HelpFunction::html('  نمودار ', $ChartsSelect, $message, $status, $_type, $from_date, $to_date);
                    } else {
                        $status = '150';
                        $message = 'illegal type';
                        return response()->json(['status' => $status, 'message' => $message]);
                    }

                } else {
                    $status = '130';
                    $message = 'The type of chart is not known';
                    return response()->json(['status' => $status, 'message' => $message]);
                }

            }
        } else {
            $status = '100';
            $message = 'illegal access';
            return response()->json(['status' => $status, 'message' => $message]);
        }
    }
}
