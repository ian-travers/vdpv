<?php

namespace App\Http\Controllers;

use App\Detainer;
use App\Wagon;

class InfoController extends Controller
{
    protected $wagonsPerPage = 10;

    public function index()
    {
        $wagons = Wagon::with('detainer')
            ->longDetainedFirst()
            ->filter(request()->only(['term']))
            ->paginate($this->wagonsPerPage);

        return view('info.index', compact('wagons'));
    }

    public function showWagon(Wagon $wagon)
    {
        return view('info.show-wagon', compact('wagon'));
    }

    public function detainedBy(Detainer $detainer)
    {
        $wagons = $detainer->wagons()
            ->longDetainedFirst()
            ->paginate($this->wagonsPerPage);

        return view('info.detained-by', compact('detainer', 'wagons'));
    }

    public function longOnly()
    {
        $wagons = Wagon::with('detainer')
            ->longDetainedOnly()
            ->paginate($this->wagonsPerPage);

        return view('info.long-only', compact('wagons'));
    }
}
