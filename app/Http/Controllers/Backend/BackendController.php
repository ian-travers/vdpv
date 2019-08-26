<?php

namespace App\Http\Controllers\Backend;

use App\Charts\WagonsPerDayChart;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    public function overall()
    {
        $chart = new WagonsPerDayChart();
        $chart->labels(['One', 'Two', 'Three', 'Four']);
        $chart->dataset('My dataset', 'line', [1, 2, 3, 4]);
        $chart->dataset('My dataset 2', 'line', [4, 3, 2, 1]);

        return view('backend.overall', compact('chart'));
    }
}
