<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PegawaiPresence;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PresensiController extends Controller
{
    public function index()
    {
        $presences = PegawaiPresence::with(['user' => function($query) {
            $query->where('name', 'like', '%'.\request()->get('search').'%');
        }])->paginate(10);

        return view('admin.pages.presensi.index', compact('presences'));
    }

    public function create()
    {
        return view('admin.pages.presensi.create', [
            'employees' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $this->rules($request);
        PegawaiPresence::create($request->all());

        return redirect(route('admin.presensi.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit(PegawaiPresence $pegawaiPresence)
    {
        return view('admin.pages.presensi.edit', [
            'pegawaiPresence' => $pegawaiPresence
        ]);
    }

    public function update(Request $request, PegawaiPresence $pegawaiPresence)
    {
        $this->rules($request);
        $pegawaiPresence->update($request->all());

        return redirect(route('admin.presensi.index'));
    }

    public function destroy(PegawaiPresence $pegawaiPresence)
    {
        $pegawaiPresence->delete();

        return back();
    }

    public function rules(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'attend_at' => ['required', 'string'],
            'out_at' => ['required', 'string'],
            'late_in_minutes' => ['required']
        ]);
    }
}
