<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Restaurante San Blas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-2xl border border-slate-800">
        
        <!-- Branding / Logo San Blas -->
        <div class="text-center space-y-2">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-amber-500 text-slate-900 text-3xl font-black shadow-lg">
                SB
            </div>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Restaurante San Blas</h1>
            <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Sistema de Control de Inventario</p>
        </div>

        <!-- Alertas de Errores -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-3 rounded text-xs text-red-700 space-y-1">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if (session('status'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-3 rounded text-xs text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulario de Login -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Campo Usuario Corregido -->
            <div>
                <label for="usuario" class="block text-xs font-semibold text-slate-700 uppercase mb-1">Usuario</label>
                <input id="usuario" type="text" name="usuario" value="{{ old('usuario') }}" required autofocus autocomplete="username"
                    placeholder="Ej. admin o chef"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm text-slate-800 focus:ring-2 focus:ring-amber-400 focus:border-amber-400 focus:outline-none transition">
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-slate-700 uppercase mb-1">Contraseña</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm text-slate-800 focus:ring-2 focus:ring-amber-400 focus:border-amber-400 focus:outline-none transition">
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-amber-500 focus:ring-amber-400">
                    <span class="text-slate-600">Recordar sesión</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-amber-600 hover:text-amber-700 font-medium">¿Olvidaste tu clave?</a>
                @endif
            </div>

            <button type="submit" 
                class="w-full py-3 px-4 bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold rounded-lg shadow-md hover:shadow-lg transition duration-200 transform active:scale-95 text-sm uppercase tracking-wider">
                Ingresar al Sistema
            </button>
        </form>

        <div class="pt-4 text-center border-t border-slate-100">
            <p class="text-xs text-slate-400">© {{ date('Y') }} San Blas - Todos los derechos reservados</p>
        </div>

    </div>

</body>
</html>