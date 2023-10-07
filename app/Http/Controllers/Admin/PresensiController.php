<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Presence;
use App\Models\User;
use App\Models\PegawaiPresence;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PresensiController extends Controller
{
    public function index()
    {
        $presences = Presence::orderby('id', 'DESC')->paginate(10);

        return view('admin.pages.presensi.index', compact('presences'));
    }

    public function create()
    {
        return view('admin.pages.presensi.create');
    }

    public function store(Request $request)
    {
        $this->rules($request);
        Presence::create(array_merge($request->all(), [
            'code' => Str::random(64)
        ]));

        return redirect(route('admin.presence.index'));
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

        return redirect(route('admin.presence.index'));
    }

    public function destroy(PegawaiPresence $pegawaiPresence)
    {
        $pegawaiPresence->delete();

        return back();
    }

    public function rules(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'valid_until' => ['required', 'string']
        ]);
    }
}
