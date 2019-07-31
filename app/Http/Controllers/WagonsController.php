<?php

namespace App\Http\Controllers;

use App\Wagon;
use Illuminate\Support\Facades\Request;

class WagonsController extends Controller
{
    public function index()
    {
        $wagons = Wagon::all();

        return view('wagons.index', compact('wagons'));
    }

    public function store()
    {
        $attributes = Request::validate([
            'inw' => 'required|regex:/\b\d{8}\b/',
            'arrived_at' => 'required|date',
            'detained_at' => 'required|date',
            'released_at' => 'nullable|date',
            'departed_at' => 'nullable|date',
            'detained_by' => 'required|max:255',
            'reason' => 'required:max:255',
            'cargo' => 'required|max:255',
            'forwarder' => 'nullable',
            'ownership' => 'nullable',
            'departure_station' => 'required|max:255',
            'destination_station' => 'required|max:255',
            'taken_measure' => 'nullable',
            'is_empty' => 'required'
        ]);

        Wagon::create($attributes);

        return redirect('/wagons');
    }
}
