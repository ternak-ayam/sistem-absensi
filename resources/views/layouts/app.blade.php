<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('admin.partials.head')
    @include('admin.partials.style')
</head>

<body>
<div class="main-wrapper main-wrapper-1" id="app">
    <!-- Main Content -->
    <div>
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
