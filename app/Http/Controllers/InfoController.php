<?php

namespace App\Http\Controllers;

use App\Detainer;
use App\Wagon;

class InfoController extends Controller
{
    protected $wagonsPerPage = 10;

    public function index()
    {
        $detainers = Detainer::all();

        $wagons = Wagon::with('detainer')
            ->latestFirst()
            ->filter(request()->only(['term']))
            ->paginate($this->wagonsPerPage);


        return view('info.index', compact('detainers', 'wagons'));
    }

    public function showWagon(Wagon $wagon)
    {
        $detainers = Detainer::all();

        return view('info.show-wagon', compact('detainers', 'wagon'));
    }

    public function detainedBy(Detainer $detainer)
    {
        $detainers = Detainer::all();

        $wagons = $detainer->wagons()
            ->latestFirst()
            ->paginate($this->wagonsPerPage);

        return view('info.index', compact('detainers', 'wagons'));
    }
}
