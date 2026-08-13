<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo-pagina', 'San Blas - Inventarios')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="h-full bg-slate-100 text-slate-800 antialiased" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex">

        <!-- Overlay móvil -->
        <div x-cloak x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
             class="fixed inset-0 z-40 bg-slate-900/80 lg:hidden"></div>

        <!-- Sidebar (estructura única para los 3 roles) -->
        <aside x-cloak :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 flex flex-col w-64 bg-emerald-950 text-white transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 flex-shrink-0 shadow-xl">

            <div class="h-16 flex items-center px-6 bg-emerald-900/80 border-b border-emerald-800/50 justify-between flex-shrink-0">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-500 text-white font-black text-lg flex items-center justify-center shadow-md">SB</div>
                    <div>
                        <h1 class="font-bold text-white text-sm tracking-wider uppercase">SAN BLAS</h1>
                        <span class="text-[10px] text-emerald-300 font-medium">@yield('sidebar-subtitulo')</span>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden text-emerald-300 hover:text-white">✕</button>
            </div>

            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                @yield('menu')
            </nav>

            <div class="p-3 border-t border-emerald-900 bg-emerald-950 flex-shrink-0">
                <div class="flex items-center justify-between p-2 rounded-lg bg-emerald-900/50">
                    <div class="flex items-center space-x-2 truncate">
                        <div class="w-8 h-8 rounded bg-emerald-500 text-white flex items-center justify-center font-bold text-xs flex-shrink-0">@yield('badge-letra', 'U')</div>
                        <div class="truncate">
                            <p class="text-xs font-bold text-white truncate">{{ auth()->user()->usuario ?? auth()->user()->nombres }}</p>
                            <span class="text-[10px] text-emerald-300 font-medium block">@yield('badge-rol')</span>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Salir" class="text-emerald-300 hover:text-red-300 p-1">🚪</button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Contenido principal -->
        <div class="flex-1 flex flex-col min-w-0 bg-slate-100">
            <header class="h-16 bg-emerald-600 text-white sticky top-0 z-30 flex items-center justify-between px-6 shadow-md flex-shrink-0">
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-white p-1">☰</button>
                <h2 class="font-semibold text-sm sm:text-base">@yield('header-titulo')</h2>
                <span class="bg-emerald-700 text-emerald-100 text-xs px-3 py-1 rounded-full border border-emerald-500/50">@yield('header-badge')</span>
            </header>

            <main class="flex-1 p-6 w-full overflow-y-auto">
                @yield('content')
            </main>
        </div>

    </div>
</body>
</html>