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
    public function index(Presence $presence)
    {
        $presences = $presence->presences()->with(['user' => function ($query) {
            $query->where('id', request()->user()->id)
                ->where('name', 'like', '%' . \request()->get('search') . '%');
        }])->paginate(10);

        return view('admin.pages.presensi.list.index', compact('presences', 'presence'));
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
    public function store(Request $request, string $code)
    {
        $user = $request->user();

        $presence = Presence::where('code', $code)->first();

        if(!$presence) {
            throw ValidationException::withMessages(['status' => 'QR Code Tidak Valid']);
        }

        $late = now()->format('H:i') <= $presence->valid_until;

        $user->presences()->create([
            'presence_id' => $presence->id,
            'scanned_at' => now(),
            'late_in_minutes' => $presence->type == PresenceTypeEnum::IN ? $late : 0
        ]);

        return redirect(route('user.presence.user.index', $presence->id));
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
