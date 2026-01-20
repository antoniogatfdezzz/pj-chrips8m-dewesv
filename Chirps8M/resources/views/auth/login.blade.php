<x-layout>
    <x-slot:title>
        Iniciar sesión
    </x-slot:title>

    <div class="min-h-[calc(100vh-10rem)] flex items-center justify-center">
        <div class="w-full max-w-md bg-white border border-slate-200 rounded-2xl shadow-sm">
            <div class="px-7 py-8">
                <h1 class="text-2xl font-semibold text-center mb-2 tracking-tight text-slate-900">Iniciar sesión</h1>
                <p class="text-xs text-center text-slate-600 mb-6">Entra para compartir memes y chirps por el 8M.</p>

                <form method="POST" action="/login" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-semibold tracking-wide text-slate-700 uppercase">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="mt-1 block w-full rounded-xl bg-slate-50 border border-slate-300 px-3 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none">
                        @error('email')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-semibold tracking-wide text-slate-700 uppercase">Contraseña</label>
                        <input id="password" type="password" name="password" required
                               class="mt-1 block w-full rounded-xl bg-slate-50 border border-slate-300 px-3 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none">
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center text-xs text-slate-700">
                            <input type="checkbox" name="remember" class="h-4 w-4 text-purple-600 bg-white border-slate-300 rounded">
                            <span class="ml-2">Recordarme</span>
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full py-2.5 px-4 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-full text-sm shadow-sm transition">
                        Entrar
                    </button>
                </form>

                <p class="mt-4 text-center text-xs text-slate-600">
                    ¿No tienes cuenta?
                    <a href="/register" class="text-purple-700 hover:text-purple-800 hover:underline font-medium">Regístrate</a>
                </p>
            </div>
        </div>
    </div>
</x-layout>
