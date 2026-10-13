<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Latihan Berpikir Logis') | LOGIKA</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
<a class="skip-link" href="#konten">Lewati ke konten</a>

<header class="navbar">
    <div class="container navbar-inner">
        <a class="logo" href="{{ route('home') }}"><span class="logo-mark">L</span>LOGIKA</a>
        <nav class="nav-links" aria-label="Navigasi utama">
            <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Beranda</a>
            <a href="{{ route('stages.index') }}" @class(['active' => request()->routeIs('stages.*', 'exercises.*', 'evaluations.show')])>Tahap Belajar</a>
            <a href="{{ route('progress.index') }}" @class(['active' => request()->routeIs('progress.index')])>Progres</a>
        </nav>
    </div>
</header>

<main id="konten" class="container main">
    @if (session('status'))
        <div class="alert alert-success" role="status">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

<footer class="footer">
    <div class="container">LOGIKA: platform latihan berpikir logis dan problem solving.</div>
</footer>

@stack('scripts')
</body>
</html>