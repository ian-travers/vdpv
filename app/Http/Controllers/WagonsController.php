<?php

namespace App\Http\Controllers;

use App\Wagon;

class WagonsController extends Controller
{
    public function index()
    {
        $wagons = Wagon::all();

        return view('wagons.index', compact('wagons'));
    }

    public function store()
    {
        Wagon::create(request()->all());

        return redirect('/wagons');
    }
}
