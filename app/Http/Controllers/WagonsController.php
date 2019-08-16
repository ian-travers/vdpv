<?php

namespace App\Http\Controllers;

use App\Detainer;
use App\Wagon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class WagonsController extends Controller
{
    protected $wagonsPerPage = 15;

    public function index()
    {
        $wagons = Auth::user()
            ->wagons()
            ->latestFirst()
            ->filter(request()->only(['term']))
            ->paginate($this->wagonsPerPage);

        return view('wagons.index', compact('wagons'));
    }

    /**
     * @param Wagon $wagon
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Wagon $wagon)
    {
        $this->authorize('manage', $wagon);

        return view('wagons.show', compact('wagon'));
    }

    public function create()
    {
        $detainers = Detainer::all();

        return view('wagons.create', compact('detainers'));
    }

    public function store()
    {
        Auth::user()->wagons()->create($this->validateRequest());

        return redirect('/wagons');
    }

    public function edit(Wagon $wagon)
    {
        $detainers = Detainer::all();

        return view('wagons.edit', compact('wagon', 'detainers'));
    }

    public function update(Wagon $wagon)
    {
        $wagon->update($this->validateRequest());

        return redirect(route('wagons.index'));
    }

    /**
     * @param Wagon $wagon
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Wagon $wagon)
    {
        $this->authorize('manage', $wagon);

        $wagon->delete();

        return redirect(route('wagons.index'));
    }

    /**
     * @return mixed
     */
    protected function validateRequest()
    {
        return Request::validate([
            'inw' => 'required|regex:/^\d{8}$/',
            'arrived_at' => 'nullable|date',
            'detained_at' => 'required|date',
            'released_at' => 'nullable|date',
            'departed_at' => 'nullable|date',
            'detainer_id' => 'required',
            'reason' => 'nullable:max:255',
            'cargo' => 'nullable|max:255',
            'forwarder' => 'nullable',
            'ownership' => 'nullable',
            'operation' => 'nullable',
            'park' => 'nullable',
            'way' => 'nullable',
            'nplf' => 'nullable',
            'departure_station' => 'nullable|max:255',
            'destination_station' => 'nullable|max:255',
            'taken_measure' => 'nullable',
        ]);
    }

}
