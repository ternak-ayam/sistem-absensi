@extends('layouts.admin')

@section('title', 'Absensi Pegawai')

@section('css')

@endsection

@section('js')
@endsection

@section('content')

<x-content>
    <x-slot name="modul">
        <h1>Presensi</h1>
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
                <a href="{{ route('admin.presence.create') }}" class="btn btn-sm btn-primary">
                        Tambah Data <i class="fas fa-plus"></i>
                    </a>
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
                            <th>Waktu Presensi Masuk</th>
                            <th>Waktu Presensi Keluar</th>
                            <th>Telat (Menit)</th>
                            <th style="width:150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($presences as $presence)
                        <tr>
                            <td>{{ $loop->index + $presences->firstItem() }}</td>
                            <td>{{ $presence->user['name'] }}</td>
                            <td>{{ $presence->attend_at }}</td>
                            <td>{{ $presence->out_at }}</td>
                            <td>{{ $presence->late_in_minutes }}</td>
                            <td>
                                <a href="{{ route('admin.user.edit', $presence->id) }}"
                                    class="btn btn-icon btn-sm btn-primary" data-toggle="tooltip"
                                    data-placement="top" title="" data-original-title="Edit">
                                    <i class="far fa-edit"></i>
                                </a>

                                <a href="{{ route('admin.user.destroy', $presence->id) }}" data-url="#"
                                    data-id="{{ $presence->id }}" data-redirect="#"
                                    class="btn btn-sm btn-danger delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
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
