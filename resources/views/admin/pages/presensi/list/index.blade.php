@extends('layouts.admin')

@section('title', 'Presensi Pegawai')

@section('css')

@endsection

@section('js')
@endsection

@section('content')

<x-content>
    <x-slot name="modul">
        <h1>Presensi <span class="text-primary">{{ $presence->title }}</span></h1>
    </x-slot>

    <x-section>
        <x-slot name="title">
        </x-slot>

        <x-slot name="header">
            <h4>Data Presensi Pegawai</h4>
            <div class="card-header-form row">
                <div>
                    <form>
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Pencarian"
                                value="{{ Request::input('search') ?? ''}}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="ml-2">
                </div>
            </div>
        </x-slot>

        <x-slot name="body">
            <div class="table-responsive">
                <table class="table table-bordered  table-md">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Waktu Presensi</th>
                            <th>Telat (Menit)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($presences as $presence)
                        <tr>
                            <td>{{ $loop->index + $presences->firstItem() }}</td>
                            <td>{{ $presence->user['name'] }}</td>
                            <td>{{ $presence->scanned_at ? $presence->scanned_at->format('F j, Y H:i') : null }}</td>
                            <td>{{ $presence->late_in_minutes }}</td>
                            <td>{{ $presence->getPresenceStatus() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <p class="text-center"><em>There is no record.</em></p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-slot>

        <x-slot name="footer">
            {{ $presences->onEachSide(2)->appends($_GET)->links('admin.partials.pagination') }}
        </x-slot>
    </x-section>

</x-content>

@endsection
