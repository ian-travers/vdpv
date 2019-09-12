<?php

namespace App\Http\Controllers\Backend;

use App\Detainer;
use Illuminate\Http\Request;
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
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Detainer $detainer)
    {
        //
    }

    public function update(Request $request, Detainer $detainer)
    {
        //
    }

    public function destroy(Detainer $detainer)
    {
        //
    }
}
