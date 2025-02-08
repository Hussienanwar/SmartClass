<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/image/logo/logo2.png') }}" />
    <title>ClassRoom</title>
</head>

<body>
    <div class="page">
        @include('layouts.components.header')
        <div class="mai-cha">
            <main class="col-3">
                @include('layouts.components.Room.AddRoom')
                @include('layouts.components.sidebar')
            </main>
            <section class="col-9">
                @yield('content')
            </section>
        </div>
    </div>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
