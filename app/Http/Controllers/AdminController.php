<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function userManagement()
    {
        $users = User::paginate(15);

        return view('userManagement.index')->with([
            'users' => $users,
        ]);
    }
}
