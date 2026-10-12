<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserWebController extends Controller
{
    public function index()
    {
        $users = User::with('role')->orderBy('name')->paginate(15);
        $roles = Role::orderBy('name')->get();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:150',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'nie'      => 'nullable|string|unique:users,nie',
            'role_id'  => 'required|exists:roles,id',
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return back()->with('success', 'Usuario creado.');
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:150',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'nie'     => 'nullable|string|unique:users,nie,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);
        $user->update($data);
        return back()->with('success', 'Usuario actualizado.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'No podés eliminarte a vos mismo.');
        }
        $user->delete();
        return back()->with('success', 'Usuario eliminado.');
    }
}