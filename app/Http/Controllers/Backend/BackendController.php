<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    public function overall()
    {
        return view('backend.overall');
    }
}
