<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('admin.partials.head')
    @include('admin.partials.style')
</head>

<body>
<div class="main-wrapper main-wrapper-1" id="app">
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
        @include('admin.partials.topnav')
    </nav>
    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Content -->
        @yield('content')
    </div>

    <div class="simple-footer">
        Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
    </div>
</div>

@include('admin.partials.script')
@include('admin.partials.notif')
</body>

</html>
