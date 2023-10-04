<?php

namespace App\Http\Controllers\User\Presensi;

use App\Http\Controllers\Controller;
use App\Models\PegawaiPresence;
use App\Models\Presence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use function back;
use function redirect;
use function view;

class PresensiController extends Controller
{
    public function index()
    {
        $presences = PegawaiPresence::with(['user' => function($query) {
            $query->where('name', 'like', '%'.\request()->get('search').'%');
        }])->paginate(10);

        return view('admin.pages.user.presensi.index', compact('presences'));
    }

    public function create()
    {
        return view('admin.pages.user.presensi.create', [
            'employees' => User::all()
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->rules($request);

        $presence = Presence::where('code', $request->input('code'))->first();

        if(!$presence) {
            throw ValidationException::withMessages(['status' => 'QR Code Tidak Valid']);
        }

        PegawaiPresence::create(array_merge($request->all(), [
            'presence_id' => $presence->id,
            'late_in_minutes' => isset($request->attend_at) ? now()->diffInMinutes($request->attend_at) : 0
        ]));

        return redirect(route('admin.presensi.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit(PegawaiPresence $pegawaiPresence)
    {
        return view('admin.pages.user.presensi.edit', [
            'pegawaiPresence' => $pegawaiPresence
        ]);
    }

    public function update(Request $request, PegawaiPresence $pegawaiPresence)
    {
        $this->rules($request);

        $pegawaiPresence->update([
            'out_at' => now()
        ]);

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
            'attend_at' => ['sometimes', 'string'],
            'out_at' => ['sometimes', 'string']
        ]);
    }
}
