<?php

namespace App\Http\Controllers\Backend;

use App\Detainer;
use App\Http\Controllers\Controller;
use App\Http\Requests\WagonRequest;
use App\Wagon;
use Illuminate\Support\Facades\Auth;

class WagonsController extends Controller
{
    protected $wagonsPerPage = 50;

    public function index()
    {
        $term = request()->only('term');

        $wagons = Wagon::sortable()
                ->filter($term)
                ->orderBy('detained_at', 'desc')
                ->paginate($this->wagonsPerPage);

        return view('backend.wagons.index', compact('wagons', 'term'));
    }

    public function show(Wagon $wagon)
    {
        return view('backend.wagons.show', compact('wagon'));
    }

    public function create()
    {
        $detainers = Detainer::all();

        return view('backend.wagons.create', compact('detainers'));
    }

    public function store(WagonRequest $request)
    {
        $request['returning'] = $request->has('returning') ? "1" : "0";

        if ($request['detainer_id'] == 7) {
            $request['taken_measure'] = null;
        } elseif (!$request['detained_at']) {
            return redirect()->back()->with([
                'flash' => [
                    'type' => 'error',
                    'text' =>'Не введена информация о дате задержания вагона',
                ]
            ]);
        }


        Auth::user()->wagons()->create($request->all());

        return redirect(route('admin.wagons.index'))->with([
            'flash' => [
                'type' => 'success',
                'text' =>'Информация по вагону сохранена',
            ]
        ]);
    }

    public function edit(Wagon $wagon)
    {
        $detainers = Detainer::all();

        session()->put('url.intended', url()->previous());

        return view('backend.wagons.edit', compact('wagon', 'detainers'));
    }

    public function update(WagonRequest $request, Wagon $wagon)
    {
        $request['returning'] = $request->has('returning') ? "1" : "0";

        if ($request['detainer_id'] == 7) {
            $request['taken_measure'] = null;
        }

        $wagon->update($request->all());

        return redirect()->intended()->with([
            'flash' => [
                'type' => 'success',
                'text' =>'Информация по вагону изменена',
            ]
        ]);
    }

    /**
     * @param Wagon $wagon
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Wagon $wagon)
    {
        $wagon->delete();

        return redirect(route('wagons.index'))->with([
            'flash' => [
                'type' => 'success',
                'text' =>'Информация по вагону удалена',
            ]
        ]);
    }
}
