<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', Rule::unique('users', 'username')->ignore($request->user()->id, 'id')],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string'],
            'state' => ['required', 'string'],
            'notes' => ['required', 'string'],
            'password' => ['required', 'confirmed']
        ]);

        $request->user()->update($request->all());

        return back();
    }
}
