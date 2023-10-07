@extends('layouts.user')

@section('title', 'Profil')

@section('css')

@endsection

@section('js')

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
                                        <div class="profile-widget-item-value">187</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Ketidakhadiran</div>
                                        <div class="profile-widget-item-value">6,8K</div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name">Ujang Maman <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> Web Developer</div></div>
                                Ujang maman is a superhero name in <b>Indonesia</b>, especially in my family. He is not a fictional character but an original hero in my family, a hero for his children and for his wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with <b>'John Doe'</b>.
                            </div>
                            <div class="card-footer text-center">
                                <a href="#" class="btn btn-icon icon-left btn-primary"><i class="fas fa-camera"></i> Scan QR Presensi</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form method="post" class="needs-validation" novalidate="">
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" value="Ujang" required="">
                                            <div class="invalid-feedback">
                                                Please fill in the first name
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Jabatan</label>
                                            <input type="text" class="form-control" value="Maman" required="">
                                            <div class="invalid-feedback">
                                                Please fill in the last name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-7 col-12">
                                            <label>Email</label>
                                            <input type="email" class="form-control" value="ujang@maman.com" required="">
                                            <div class="invalid-feedback">
                                                Please fill in the email
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5 col-12">
                                            <label>No. Telepon</label>
                                            <input type="tel" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Bio</label>
                                            <textarea class="form-control" style="height: 120px">Ujang maman is a superhero name in &lt;b&gt;Indonesia&lt;/b&gt;, especially in my family. He is not a fictional character but an original hero in my family, a hero for his children and for his wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with &lt;b&gt;'John Doe'&lt;/b&gt;.</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-content>

@endsection
