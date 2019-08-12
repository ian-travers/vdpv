<?php

namespace App\Http\Controllers;

use App\Detainer;
use App\Wagon;

class InfoController extends Controller
{
    public function overall()
    {
        $detainers = Detainer::all();

        $total = Wagon::detainedAllCount();
        $totalLong = Wagon::detainedLongCount();

        return view('info.overall', compact('detainers', 'total', 'totalLong'));
    }
}
