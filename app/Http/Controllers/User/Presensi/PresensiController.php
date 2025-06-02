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
        }])->whereNotNull('scanned_at')->paginate(10);

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
    public function store(Request $request, string $code, string $type)
    {
        $user = $request->user();

        $presence = Presence::where('code', $code)->firstOr(function () {
            throw ValidationException::withMessages(['status' => 'QR Code Tidak Valid']);
        });
    
        $userPresence = $user->presences()->where('presence_id', $presence->id)->first();
    
        // $late = now()->format('H:i') <= $presence->valid_until;
        if ($type == PresenceTypeEnum::IN) {
            // $validUntil = \Carbon\Carbon::createFromFormat('H:i', $presence->valid_until);
            $validUntil = \Carbon\Carbon::parse($presence->valid_until, 'Asia/Jakarta');
            $diff = now()->diffInMinutes($validUntil, false);
            $late = $diff < 0 ? abs($diff) : 0; // hanya hitung keterlambatan
        }

        $data = [
            'scanned_at' => now(),
            'late_in_minutes' => $late,
        ];
    
        if ($userPresence) {
            $userPresence->update($data);
        } else {
            $user->presences()->create(array_merge(['presence_id' => $presence->id], $data));
        }
    
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
