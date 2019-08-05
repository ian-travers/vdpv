<?php

namespace App\Http\Controllers;

use App\Wagon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class WagonsController extends Controller
{
    public function index()
    {
        $wagons = Auth::user()->wagons;

        $locale = config('app.locale');

        return view('wagons.index', compact('wagons', 'locale'));
    }

    public function show(Wagon $wagon)
    {
        if (Auth::user()->isNot($wagon->creator)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('wagons.show', compact('wagon'));
    }

    public function create()
    {
        return view('wagons.create');
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
            'is_empty' => 'nullable'
        ]);

        Auth::user()->wagons()->create($attributes);

        return redirect('/wagons');
    }

    public function edit(Wagon $wagon)
    {
        return view('wagons.edit', compact('wagon'));
    }

    public function update(Wagon $wagon)
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
            'is_empty' => 'nullable'
        ]);

        $wagon->update($attributes);

        return redirect(route('wagons.index'));
    }

    /**
     * @param Wagon $wagon
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Wagon $wagon)
    {
        $wagon->delete();

        return redirect(route('wagons.index'));
    }
}
