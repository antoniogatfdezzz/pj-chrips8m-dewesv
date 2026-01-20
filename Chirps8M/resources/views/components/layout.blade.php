<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Chirps-8M' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @keyframes fade-out {
            0%, 60% {
                opacity: 1;
            }
            100% {
                opacity: 0;
                pointer-events: none;
                visibility: hidden;
            }
        }

        .animate-fade-out {
            animation: fade-out 5s ease-in-out forwards;
        }
    </style>
</head>
<body class="min-h-screen bg-white text-slate-900 flex flex-col">
    <header class="border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="max-w-5xl mx-auto px-4 py-3 flex justify-between items-center gap-4">
            <a href="/" class="flex items-center gap-2 group">
                <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center shadow-sm border border-purple-200">
                    {{-- Lazo morado del 8M --}}
                    <svg viewBox="0 0 24 24" class="h-5 w-5 text-purple-600" aria-hidden="true">
                        <path fill="currentColor" d="M12 2.5c-2.5 0-4.5 2-4.5 4.6 0 1.5.7 3 1.9 4.5L7 17.8c-.3.6-.1 1.4.5 1.7.6.4 1.4.2 1.8-.4l2.7-4.4 2.7 4.4c.4.6 1.2.8 1.8.4.6-.3.8-1.1.5-1.7l-2.4-4.2c1.2-1.5 1.9-3 1.9-4.5C16.5 4.5 14.5 2.5 12 2.5zm0 2c1.4 0 2.5 1.2 2.5 2.6 0 .9-.4 1.9-1.3 3.1-.4.5-.8 1-1.2 1.5-.4-.5-.8-1-.2-1.5-.9-1.2-1.3-2.2-1.3-3.1 0-1.4 1.1-2.6 2.5-2.6z" />
                    </svg>
                </div>
                <div class="leading-tight">
                    <p class="text-sm font-semibold tracking-tight text-slate-900 group-hover:text-purple-700 transition-colors">Chirps-8M</p>
                </div>
            </a>

            <div class="flex items-center gap-3">
                @auth
                    <span class="hidden sm:inline text-sm text-slate-700">{{ auth()->user()->name }}</span>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button
                            type="submit"
                            class="text-xs sm:text-sm px-3 py-1.5 rounded-full border border-slate-200 bg-slate-50 hover:bg-slate-100 font-semibold tracking-tight text-slate-800 transition">
                            Cerrar sesión
                        </button>
                    </form>
                @else
                    <a href="/login" class="text-xs sm:text-sm font-medium text-slate-700 hover:text-purple-700 transition">Iniciar sesión</a>
                    <a
                        href="/register"
                        class="text-xs sm:text-sm font-semibold px-3 sm:px-4 py-1.5 rounded-full bg-purple-600 text-white shadow-sm hover:shadow-md hover:bg-purple-700 transition">
                        Registrarse
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Success Toast -->
    @if (session('success'))
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50">
            <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg animate-fade-out">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        </div>
    @endif

    <main class="flex-1 py-10 bg-slate-50">
        <div class="max-w-5xl mx-auto px-4">
            {{ $slot }}
        </div>
    </main>

    <footer class="border-t border-slate-200 bg-white text-slate-500 text-xs sm:text-sm">
        <div class="max-w-5xl mx-auto px-4 py-4 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p class="tracking-tight">&copy; {{ date('Y') }} Chirps-8M. Construido con Laravel.</p>
            <p class="text-slate-400">Antonio Gat Fernández - 2º DAW</p>
        </div>
    </footer>
</body>
</html>
