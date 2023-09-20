<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('name', 'like', '%'.\request()->get('search').'%')->paginate(10);

        return view('admin.pages.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.pages.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', 'unique:users'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed']
        ]);


        User::create(array_merge($request->all()));

        return redirect(route('admin.user.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        return view('admin.pages.user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', Rule::unique('admins', 'username')->ignore($user->id, 'id')],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
            'status' => ['required']
        ]);

        $user->update($request->all());

        return redirect(route('admin.user.index'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
