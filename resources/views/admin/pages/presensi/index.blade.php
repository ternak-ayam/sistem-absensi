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
                <h4>Data Presensi</h4>
                <div class="card-header-form row">
                    <div>
                        <form>
                            <div class="input-group">
                                <input type="text" name="search" id="search" class="form-control"
                                       placeholder="Pencarian"
                                       value="{{ Request::input('search') ?? ''}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @auth('admin')
                        <div class="ml-2">
                            <a href="{{ route('admin.presence.create') }}" class="btn btn-sm btn-primary">
                                Tambah Data <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    @endauth
                </div>
            </x-slot>

            <x-slot name="body">
                <div class="table-responsive">
                    <table class="table table-bordered  table-md">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Batas Waktu Kehadiran</th>
                            <th>Jumlah Hadir</th>
                            <th>Jumlah Belum Hadir</th>
                            <th>Jumlah Telat</th>
                            <th style="width:150px">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($presences as $presence)
                            <tr>
                                <td>{{ $loop->index + $presences->firstItem() }}</td>
                                <td>{{ $presence->title }}</td>
                                <td>{{ $presence->valid_until }}</td>
                                <td>{{ $presence->getAttends() }}</td>
                                <td>{{ $presence->getNotAttends() }}</td>
                                <td>{{ $presence->getLates() }}</td>
                                <td>
                                    @auth('web')
                                        <a href="{{ route('user.presence.user.index', $presence->id) }}"
                                           class="btn btn-icon btn-sm btn-primary" data-toggle="tooltip"
                                           data-placement="top" title="" data-original-title="View">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    @endauth
                                    @auth('admin')
                                        <a href="{{ route('admin.pegawai.presence.index', $presence->id) }}"
                                           class="btn btn-icon btn-sm btn-primary" data-toggle="tooltip"
                                           data-placement="top" title="" data-original-title="View">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.presence.destroy', $presence->id) }}"
                                           class="btn btn-icon btn-sm btn-danger" data-toggle="tooltip"
                                           data-placement="top" title="" data-original-title="Delete">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    @endauth
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
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
