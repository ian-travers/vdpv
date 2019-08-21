<?php

namespace App\Http\Controllers;

use App\Detainer;
use App\Http\Requests\WagonRequest;
use App\Wagon;
use Illuminate\Support\Facades\Auth;

class WagonsController extends Controller
{
    protected $wagonsPerPage = 20;

    public function index()
    {
        $term = request()->only('term');

        $wagons = Auth::user()
            ->wagons()
            ->filter($term)
            ->paginate($this->wagonsPerPage);

        return view('wagons.index', compact('wagons', 'term'));
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

    public function store(WagonRequest $request)
    {
        Auth::user()->wagons()->create($request->all());

        return redirect(route('wagons.index'))->with([
            'message' => 'Информация по вагону сохранена',
            'type' => 'success'
        ]);
    }

    public function edit(Wagon $wagon)
    {
        $detainers = Detainer::all();

        return view('wagons.edit', compact('wagon', 'detainers'));
    }

    public function update(WagonRequest $request, Wagon $wagon)
    {
        $wagon->update($request->all());

        return redirect(route('wagons.index'))->with([
            'message' => 'Информация по вагону изменена',
            'type' => 'success',
        ]);
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

        return redirect(route('wagons.index'))->with([
            'message' => 'Информация по вагону удалена',
            'type' => 'success',
        ]);
    }
}
