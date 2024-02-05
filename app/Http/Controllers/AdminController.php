<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function userManagement()
    {
        $users = User::paginate(15);

        return view('userManagement.index')->with([
            'users' => $users,
        ]);
    }

    public function editUser(UserRequest $request, int $userId)
    {
        $user = User::find($userId);
        $role = $request->role;
        if ($role != 0) {
            $request->validate([
                'role' => 'required|exists:roles,name'
            ]);
        } else {
            $role = "";
        }

        $user->name = $request->name;
        $user->abbreviation = $request->abbreviation;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->syncRoles($role);
        $user->save();

        return redirect()->back()->with('success', __('User successfully edited'));
    }

    public function createUser(UserRequest $request)
    {
        $role = $request->role;

        $request->validate([
            'password' => ['confirmed']
        ]);

        if ($role != 0) {
            $request->validate([
                'role' => 'required|exists:roles,name'
            ]);
        } else {
            $role = "";
        }

        $user = new User();
        $user->name = $request->name;
        $user->abbreviation = $request->abbreviation;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->syncRoles($role);

        return redirect()->back()->with('success', __('User successfully created'));
    }

    public function deleteUser(int $userId)
    {
        $user = User::find($userId);
        $user->delete();

        return redirect()->back()->with('success', __('User successfully deleted'));
    }
}
