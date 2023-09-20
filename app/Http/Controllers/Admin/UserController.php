<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = Admin::where('role', Admin::PEGAWAI)->where('name', 'like', '%'.\request()->get('search').'%')->paginate(10);

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
            'username' => ['required', 'unique:admins'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed']
        ]);
        

        Admin::create(array_merge($request->all(), ['role' => Admin::PEGAWAI]));

        return redirect(route('admin.user.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit(Admin $admin)
    {
        return view('admin.pages.user.edit', [
            'user' => $admin
        ]);
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', Rule::unique('admins', 'username')->ignore($admin->id, 'id')],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed']
        ]);

        $admin->update($request->all());

        return redirect(route('admin.user.index'));
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();

        return back();
    }
}
