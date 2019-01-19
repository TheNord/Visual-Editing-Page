<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
</head>
<body>
    @include('layouts.topMenu')

    <main class="app-content py-3">
        <div class="container">
            @include('layouts.partials.flash')
            @yield('content')
        </div>
    </main>


@if (auth() -> check() && auth()->user()->isAdmin() && !Request::is('admin*'))
    @include('admin.partials.bar')

    @if (Session::get('interactive-editing'))
        <script src="assets/content-tools.min.js"></script>
        <script src="assets/editor.js"></script>

        <script>
            window.page = {{$page->id}};
            window.token = "{{csrf_token()}}";
        </script>
    @endif

@endif
</body>
</html>
