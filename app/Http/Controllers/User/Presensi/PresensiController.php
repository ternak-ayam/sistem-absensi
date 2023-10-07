<?php

namespace App\Http\Controllers\User\Presensi;

use App\Enums\PresenceTypeEnum;
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
        $user = $request->user();

        $presence = Presence::where('code', $request->input('code'))->first();

        if(!$presence) {
            throw ValidationException::withMessages(['status' => 'QR Code Tidak Valid']);
        }

        $late = now()->format('H:i') <= $presence->valid_until;

        $user->presences()->create(array_merge($request->all(), [
            'presence_id' => $presence->id,
            'scanned_at' => now(),
            'type' => $presence->type,
            'late_in_minutes' => $presence->type == PresenceTypeEnum::IN ? $late : 0
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

    public function destroy(PegawaiPresence $pegawaiPresence)
    {
        $pegawaiPresence->delete();

        return back();
    }

    public function rules(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id']
        ]);
    }
}
