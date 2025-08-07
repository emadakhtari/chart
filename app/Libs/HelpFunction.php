<?php

namespace App\Libs;

use App\Models\ChartItems;

class HelpFunction
{
    public static function result($responseCode = 1, $message = [], $status = 200, $data = [])
    {
        return response()->json(
            [
                'responseCode' => $responseCode,
                'message' => $message,
                'result' => $data,
                'status' => $status
            ]
        );
    }

    public static function html($title, $ChartsSelect, $message, $status, $_type, $from_date, $to_date)
    {
        if ($from_date && !$to_date) {
            $dataItem = ChartItems::where('chart_id', $ChartsSelect->id)
                ->where('y_value', '>=', $from_date)
                ->get();

            $dataItemSlect = ChartItems::where('chart_id', $ChartsSelect->id)
                ->where('y_value', '>=', $from_date)
                ->orderBy('id', 'DESC')->first();

            $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                ->where('y_value', '>=', $from_date)
                ->skip(7)
                ->orderBy('id', 'DESC')->first();
            if (!isset($dataItemSlect_next)) {
                $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                    ->where('y_value', '>=', $from_date)
                    ->skip(6)
                    ->orderBy('id', 'DESC')->first();
                if (!isset($dataItemSlect_next)) {

                    $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                        ->where('y_value', '>=', $from_date)
                        ->skip(5)
                        ->orderBy('id', 'DESC')->first();
                    if (!isset($dataItemSlect_next)) {

                        $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                            ->where('y_value', '>=', $from_date)
                            ->skip(4)
                            ->orderBy('id', 'DESC')->first();
                    } else {

                        $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                            ->where('y_value', '>=', $from_date)
                            ->orderBy('id', 'DESC')->first();
                    }
                }
            }


        } elseif ($from_date && $to_date) {
            $dataItem = ChartItems::where('chart_id', $ChartsSelect->id)
                ->where('y_value', '>=', $from_date)
                ->whereBetween('y_value', [$from_date, $to_date])
                ->get();
            $dataItemSlect = ChartItems::where('chart_id', $ChartsSelect->id)
                ->where('y_value', '>=', $from_date)
                ->whereBetween('y_value', [$from_date, $to_date])
                ->orderBy('id', 'DESC')->first();

            $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                ->where('y_value', '>=', $from_date)
                ->whereBetween('y_value', [$from_date, $to_date])
                ->skip(7)
                ->orderBy('id', 'DESC')->first();
            if (!isset($dataItemSlect_next)) {
                $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                    ->where('y_value', '>=', $from_date)
                    ->whereBetween('y_value', [$from_date, $to_date])
                    ->skip(6)
                    ->orderBy('id', 'DESC')->first();
                if (!isset($dataItemSlect_next)) {
                    $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                        ->where('y_value', '>=', $from_date)
                        ->whereBetween('y_value', [$from_date, $to_date])
                        ->skip(5)
                        ->orderBy('id', 'DESC')->first();
                    if (!isset($dataItemSlect_next)) {
                        $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                            ->where('y_value', '>=', $from_date)
                            ->whereBetween('y_value', [$from_date, $to_date])
                            ->skip(4)
                            ->orderBy('id', 'DESC')->first();
                    } else {
                        $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                            ->where('y_value', '>=', $from_date)
                            ->whereBetween('y_value', [$from_date, $to_date])
                            ->orderBy('id', 'DESC')->first();
                    }
                }
            }
        } else {
            $dataItem = ChartItems::where('chart_id', $ChartsSelect->id)
                ->get();

            $dataItemSlect = ChartItems::where('chart_id', $ChartsSelect->id)
                ->orderBy('id', 'DESC')->first();
            $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                ->skip(7)
                ->orderBy('id', 'DESC')->first();

            if (!isset($dataItemSlect_next)) {
                $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                    ->skip(6)
                    ->orderBy('id', 'DESC')->first();
                if (!isset($dataItemSlect_next)) {
                    $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                        ->skip(5)
                        ->orderBy('id', 'DESC')->first();
                    if (!isset($dataItemSlect_next)) {
                        $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                            ->skip(4)
                            ->orderBy('id', 'DESC')->first();
                    } else {
                        $dataItemSlect_next = ChartItems::where('chart_id', $ChartsSelect->id)
                            ->orderBy('id', 'DESC')->first();
                    }
                }
            }
        }

        $newStart = $dataItemSlect_next->y_value * 1000;
        $newEnd = $dataItemSlect->y_value * 1000;

        $html = '';
        $html .= '
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
<style>
    .highcharts-title {
        direction: rtl;
    }

    .highcharts-scrollbar [transform] {
        display: none !important;
    }

    .highcharts-scrollbar-track {
        fill: white;
        opacity: 0;
    }

    .highcharts-navigator-mask-inside {
        height: 54px !important;
    }

    .highcharts-navigator-mask-outside {
        height: 54px !important;
    }

    .highcharts-input-group {
        display: none !important;
    }

    .highcharts-range-selector-group {
        display: none !important;
    }

    tspan {
        white-space: normal !important;
    }

    .highcharts-menu {
        direction: rtl !important;
        text-align: right;
    }

    .highcharts-menu li {
        direction: rtl !important;
        text-align: right;
    }

    .highcharts-credits[text-anchor="end"] {
        display: none !important;
    }
</style>

<script type="text/javascript"
        src="' . asset('js/chart/highstock.js') . '"></script>
<script type="text/javascript"
        src="' . asset('js/chart/data.js') . '"></script>
<script type="text/javascript"
        src="' . asset('js/chart/exporting.js') . '"></script>
<script type="text/javascript"
        src="' . asset('js/chart/export-data.js') . '"></script>
<script type="text/javascript"
        src="' . asset('js/chart/persian-date.js') . '"></script>

    <script type="text/javascript">
        Highcharts.dateFormats = {
            "a": function (ts) {
                return new persianDate(ts).format("dddd")
            },
            "A": function (ts) {
                return new persianDate(ts).format("dddd")
            },
            "d": function (ts) {
                return new persianDate(ts).format("DD")
            },
            "e": function (ts) {
                return new persianDate(ts).format("D")
            },
            "b": function (ts) {
                return new persianDate(ts).format("MMMM")
            },
            "B": function (ts) {
                return new persianDate(ts).format("MMMM")
            },
            "m": function (ts) {
                return new persianDate(ts).format("MM")
            },
            "y": function (ts) {
                return new persianDate(ts).format("YY")
            },
            "Y": function (ts) {
                return new persianDate(ts).format("YYYY")
            },
            "W": function (ts) {
                return new persianDate(ts).format("ww")
            }
        };
        Highcharts.setOptions({
            lang: {
                thousandsSep: ","
            }
        });
        document.addEventListener("DOMContentLoaded", function () {
            // create the chart
            Highcharts.stockChart("container", {
                chart: {
                    alignTicks: false,
                    events: {
                        load: function () {
                            var chart = this,
                                xAxis = chart.xAxis[0],

                                newStart = ' . $newStart . ',
                                newEnd = ' . $newEnd . ';

                            xAxis.setExtremes(newStart, newEnd);
                        }
                    }
                },
                rangeSelector: {
                    selected: 1
                },
                title: {
                     text: "' . $ChartsSelect->title . '"
                },
                yAxis: {
                    labels: {
                        formatter: function () {
                            var number = this.value;
                          return number.toLocaleString() + "' . $ChartsSelect->_value . '";
                        }
                    },
                },
                series: [{
                    type: "' . $_type . '",
                    name: "' . $ChartsSelect->_value . '",
                    data: [
                        ';
        foreach ($dataItem as $value) {
            $html .= '[' . $value->y_value . '000, ' . $value->x_value . '],';
        }

        $html .= '
                    ],
                    dataGrouping: {
                        enabled: true,
                        units: [["month", [1]]],
                    },
                }]
            });
        });


    </script>
    <div id="container" style="height: 500px"></div>
    </body>
</html>
    ';


        return $html;
    }
}
