<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f4f6f9;
            margin: 0;
        }

        /* ===== LAYOUT ===== */
        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            background-color: #ffffff;
            width: 240px;
            margin: 15px;
            border-radius: 20px;
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .user-name {
            font-size: 22px;
            font-weight: 700;
            color: #000;
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        /* ===== SEARCH ===== */
        .search-box {
            position: relative;
            margin: 20px 0;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-input {
            width: 100%;
            padding: 10px 12px 10px 38px;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            font-size: 18px;
            color: #666;
            pointer-events: none;
        }

        .sidebar.collapsed .search-input {
            display: none;
        }

        .sidebar.collapsed .search-icon {
            position: static;
            width: 100%;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ===== NAV ===== */
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            color: #333;
            font-weight: 500;
            margin-bottom: 6px;
            transition: background 0.2s ease;
        }

        .nav-link:hover {
            background-color: #f2f2f2;
        }

        .nav-link.active {
            background-color: #f0f0f0;
        }

        .nav-text {
            transition: opacity 0.2s ease;
        }

        .sidebar.collapsed .nav-text {
            display: none;
        }

        /* ===== CONTENT ===== */
        .content {
            flex: 1;
            background-color: #ffffff;
            margin: 15px 15px 15px 0;
            border-radius: 20px;
            padding: 30px;
        }

        /* ===== FLOATING ASSISTANT ===== */
        .nohands-floating {
            position: fixed;
            right: 25px;
            bottom: 25px;
            z-index: 9999;
        }

        .nohands-btn {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            border: none;
            background-color: #ffffff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .nohands-btn:hover {
            transform: scale(1.08);
            box-shadow: 0 12px 28px rgba(0,0,0,0.25);
        }

        .nohands-btn img {
            width: 42px;
            height: 42px;
        }

        .nohands-active {
            box-shadow:
                0 0 0 4px rgba(40,167,69,0.35),
                0 8px 20px rgba(0,0,0,0.2);
        }
    </style>

    @stack('css')
</head>
<body>

<div class="layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">

        <div class="d-flex justify-content-between align-items-center">
            <span class="user-name nav-text">Chris</span>
            <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        </div>

        <div class="search-box">
            <input type="text" class="search-input" placeholder="Buscar">
            <span class="search-icon">🔍</span>
        </div>

        <nav class="nav flex-column mb-3">
            <a href="{{ route('dashboard') }}" class="nav-link active">
                🏠 <span class="nav-text">Inicio</span>
            </a>
            <a href="{{ route('notes') }}" class="nav-link">
                📝 <span class="nav-text">Notas</span>
            </a>
            <a href="{{ route('flashcards') }}" class="nav-link">
                📚 <span class="nav-text">Flashcards</span>
            </a>
            <a href="{{ route('profile') }}" class="nav-link">
                👤 <span class="nav-text">Perfil</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="#" class="nav-link">
                ⚙️ <span class="nav-text">Configuración</span>
            </a>
            <a href="#" class="nav-link">
                🗑️ <span class="nav-text">Papelera</span>
            </a>
        </div>

    </aside>

    {{-- CONTENT --}}
    <main class="content">
        @yield('content')
    </main>

</div>

{{-- FLOATING NO HANDS ASSISTANT --}}
<div class="nohands-floating">
    <form method="POST" action="{{ route('nohands.toggle') }}">
        @csrf
        <button type="submit"
                class="nohands-btn {{ session('nohands_active') ? 'nohands-active' : '' }}"
                title="{{ session('nohands_active') ? 'Desactivar control por gestos' : 'Activar control por gestos' }}">
            <img src="{{ asset('images/mancha.jpeg') }}" alt="No Hands Assistant">
        </button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('collapsed');
    }
</script>

@stack('js')
</body>
</html>
