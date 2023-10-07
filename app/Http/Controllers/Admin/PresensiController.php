<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Presence;
use App\Models\User;
use App\Models\PegawaiPresence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PresensiController extends Controller
{
    public function index()
    {
        $presences = Presence::where('title', 'like','%'.request()->get('search').'%')->orderby('id', 'DESC')->paginate(10);

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

    public function edit(Presence $presence)
    {
        return view('admin.pages.presensi.edit', [
            'pegawai' => $presence
        ]);
    }

    public function update(Request $request, PegawaiPresence $pegawaiPresence)
    {
        $this->rules($request);
        $pegawaiPresence->update($request->all());

        return redirect(route('admin.presence.index'));
    }

    public function destroy(Presence $presence)
    {
        $presence->delete();

        return back();
    }

    public function download($code)
    {
        QrCode::generate($code, storage_path("app/$code.svg"));

        return Storage::disk('local')->download("$code.svg");
    }

    public function rules(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'valid_until' => ['required', 'string']
        ]);
    }
}
