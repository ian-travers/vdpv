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

        $wagons = auth()->user()->isLocalWagonsManager()
            ? Wagon::where('detainer_id', 7)
                ->sortable()
                ->filter($term)
                ->orderBy('detained_at', 'desc')
                ->paginate($this->wagonsPerPage)
            : Wagon::sortable()
                ->filter($term)
                ->orderBy('detained_at', 'desc')
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
        return view('wagons.show', compact('wagon'));
    }

    public function create()
    {
        $detainers = $this->prepareDetainers();

        return view('wagons.create', compact('detainers'));
    }

    public function store(WagonRequest $request)
    {
        $request['returning'] = $request->has('returning') ? "1" : "0";

        if ($request['detainer_id'] == 7) {
            $request['taken_measure'] = null;
        }

        Auth::user()->wagons()->create($request->all());

        return redirect(route('wagons.index'))->with([
            'message' => 'Информация по вагону сохранена',
            'type' => 'success'
        ]);
    }

    /**
     * @param Wagon $wagon
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Wagon $wagon)
    {
        $this->authorize('manage', $wagon);

        $detainers = $this->prepareDetainers();

        session()->put('url.intended', url()->previous());

        return view('wagons.edit', compact('wagon', 'detainers'));
    }

    /**
     * @param WagonRequest $request
     * @param Wagon $wagon
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(WagonRequest $request, Wagon $wagon)
    {
        $this->authorize('manage', $wagon);

        $request['returning'] = $request->has('returning') ? "1" : "0";

        if ($request['detainer_id'] == 7) {
            $request['taken_measure'] = null;
        }

        $wagon->update($request->all());

        return redirect()->intended()->with([
            'message' => 'Информация по вагону изменена',
            'type' => 'success'
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

    private function prepareDetainers()
    {
        return auth()->user()->isLocalWagonsManager()
            ? Detainer::where('id', 7)->get()
            : Detainer::all();
    }
}
