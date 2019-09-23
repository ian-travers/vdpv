<?php

namespace App\Http\Controllers\Backend;

use App\Detainer;
use App\Http\Controllers\Controller;

class DetainersController extends Controller
{
    public function index()
    {
        $detainers = Detainer::paginate(20);

        return view('backend.detainers.index', compact('detainers'));
    }

    public function create()
    {
        $detainer = new Detainer();

        return view('backend.detainers.create', compact('detainer'));
    }

    public function store()
    {
        Detainer::create($this->validateRequest());

        return redirect()->route('admin.detainers.index')->with([
            'flash' => [
                'type' => 'success',
                'text' =>'Организация сохранена',
            ]
        ]);
    }

    public function edit(Detainer $detainer)
    {
        return view('backend.detainers.edit', compact('detainer'));
    }

    public function update(Detainer $detainer)
    {
        $detainer->update($this->validateRequest());

        return redirect()->route('admin.detainers.index')->with([
            'flash' => [
                'type' => 'success',
                'text' =>'Организация изменена',
            ]
        ]);
    }

    /**
     * @param Detainer $detainer
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Detainer $detainer)
    {
        $detainer->delete();

        return redirect()->route('admin.detainers.index')->with([
            'flash' => [
                'type' => 'success',
                'text' =>'Организация удалена',
            ]
        ]);
    }

    protected function validateRequest()
    {
        return request()->validate([
            'name' => 'required|string|max:100',
            'idle_start_event' => 'required|string|max:20',
        ]);
    }
}
