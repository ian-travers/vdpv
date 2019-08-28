<?php

namespace App\Http\Controllers\Backend;

use App\Charts\LastTenDaysStatisticsChart;
use App\Charts\WagonsPerDayChart;
use App\Detainer;
use App\Http\Controllers\Controller;
use App\Wagon;

class BackendController extends Controller
{
    public function overall()
    {
        $lastTenDaysStats = new LastTenDaysStatisticsChart();

        $wagonsBy = Wagon::selectRaw('count(*) as cnt, detainer_id')
            ->groupBy('detainer_id')
            ->get()
            ->toArray();

        $labels = [];
        $data = [];
        foreach ($wagonsBy as $item) {
//            if ($item['cnt'] < 100) {
            $labels[] = Detainer::find($item['detainer_id'])->name;
            $data[] = $item['cnt'];
//            }
        }
        $chartBy = new WagonsPerDayChart();
        $chartBy->labels(array_values($labels));
        $chartBy->dataset('By Detainers', 'pie', array_values($data))
            ->backgroundcolor([
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ]);
        $chartBy->displayAxes(false);
        $chartBy->width = 250;
        $chartBy->options([
            'plugins' => '{
                datalabels: {
                    color: "#141518",
                    align: "center",
                    anchor: "center",
                }
            }',
        ]);


        return view('backend.overall', compact('lastTenDaysStats', 'chartBy'));
    }
}
