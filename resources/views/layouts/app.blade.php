<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KiemKracht</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @php
        $bg = asset('background.svg');
    @endphp

    <style>
        body {
            background-image: url("{{ $bg }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-custom mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold d-inline-block" href="{{ url('/') }}" style="color: #F1D09F; text-align: left;">
            <div style="line-height: 0.8;">KIEM</div>
            <div style="line-height: 0.8;">KRACHT.</div>
        </a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">

                @auth
                    <li class="nav-item me-2">
                        <a href="{{ route('tickets.index') }}" 
                           class="btn btn-sm"
                           style="color: #F1D09F; border: 1px solid #F1D09F;">
                            Overzicht
                        </a>
                    </li>

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm" style="color: #F1D09F; border: 1px solid #F1D09F;">
                                Logout
                            </button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login.show') }}" style="color: #F1D09F;">
                            Login
                        </a>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

<script>
    let keys = [];
    const secret = [
        'ArrowUp', 'ArrowUp',
        'ArrowDown', 'ArrowDown',
        'ArrowLeft', 'ArrowRight',
        'ArrowLeft', 'ArrowRight',
        
    ];

    document.addEventListener('keydown', function(e) {
        keys.push(e.key);
        keys.splice(-secret.length - 1, keys.length - secret.length);

        if (keys.join('').includes(secret.join(''))) {
            showEasterEgg();
        }
    });

    function showEasterEgg() {
        const existing = document.getElementById('konami-message');
        if (existing) existing.remove();

        const div = document.createElement('div');
        div.id = 'konami-message';
        div.innerText = 'KiemKracht on 🔝';

        div.style.position = 'fixed';
        div.style.bottom = '20px';
        div.style.left = '50%';
        div.style.transform = 'translateX(-50%)';
        div.style.backgroundColor = '#782F40';
        div.style.color = '#F1D09F';
        div.style.padding = '10px 20px';
        div.style.border = '1px solid #F1D09F';
        div.style.borderRadius = '6px';
        div.style.fontWeight = 'bold';
        div.style.zIndex = '9999';
        div.style.boxShadow = '0 4px 12px rgba(0,0,0,0.3)';

        document.body.appendChild(div);

        console.log('KiemKracht on 🔝');

        setTimeout(() => {
            div.remove();
        }, 3000);
    }
</script>
</body>
</html>