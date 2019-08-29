<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);

        return view('backend.users.index', compact('users'));
    }
}
