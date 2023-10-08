@extends('layouts.user')

@section('title', 'Profil')

@section('css')

@endsection

@section('js')
    <script>
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess);

        function onScanSuccess(decodedText) {

            window.location.href = route('user.presence.user.store', decodedText);

            html5QrcodeScanner.clear();

            return decodedText;
        }

    </script>
@endsection

@section('content')
    <x-content>
        <x-slot name="modul">
            <h1>Profil</h1>
        </x-slot>
        <section class="section">
            <div class="section-body">
                <h2 class="section-title">Hi, {{ $user->name }}!</h2>
                <p class="section-lead">
                    Ubah informasi tentang dirimu disini
                </p>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <img alt="image" src="{{ $user->getImageUrl() }}" class="rounded-circle profile-widget-picture">
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Kehadiran</div>
                                        <div class="profile-widget-item-value">{{ $user->getAttends() }}</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Ketidakhadiran</div>
                                        <div class="profile-widget-item-value">{{ $user->getNotAttends() }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name">{{ $user->name }} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{ $user->state }}</div></div>
                                {{ $user->notes }}
                            </div>
                            <div class="card-header">
                                <h4>Scan QR Presensi</h4>
                            </div>
                            <div id="reader" width="600px"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form method="post" class="needs-validation" action="{{ route('user.update') }}">
                                @method('PUT')
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Profil</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required="">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}" required="">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Jabatan</label>
                                            <input type="text" class="form-control" name="state" id="state" value="{{ $user->state }}" required="">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-7 col-12">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" required="">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-5 col-12">
                                            <label>No. Telepon</label>
                                            <input type="tel" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" id="password" required="">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Password Confirmation</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required="">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Catatan</label>
                                            <textarea name="notes" id="notes" class="form-control" style="height: 120px">{{ $user->notes }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-content>

@endsection
