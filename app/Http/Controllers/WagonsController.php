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
                ->orderBy('detained_at')
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
        } elseif (!$request['detained_at']) {
            return redirect()->back()->with([
                'flash' => [
                    'type' => 'error',
                    'text' =>'Не введена информация о дате задержания вагона',
                ]
            ]);
        }


        Auth::user()->wagons()->create($request->all());

        return redirect(route('wagons.index'))->with([
            'flash' => [
                'type' => 'success',
                'text' =>'Информация по вагону сохранена',
            ]
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

        session()->put('url.intended', url()->previous() == url()->current() ? route('wagons.index') : url()->previous());

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
        $this->authorize('manage', $wagon);

        $wagon->delete();

        return redirect(route('wagons.index'))->with([
            'flash' => [
                'type' => 'success',
                'text' =>'Информация по вагону удалена',
            ]
        ]);
    }

    private function prepareDetainers()
    {
        return auth()->user()->isLocalWagonsManager()
            ? Detainer::where('id', 7)->get()
            : Detainer::all();
    }
}
