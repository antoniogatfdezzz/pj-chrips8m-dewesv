<x-layout>
    <x-slot:title>
        Editar Meme
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <div class="mt-4 mb-4 flex flex-col gap-2">
            <h1 class="text-3xl md:text-4xl font-semibold tracking-tight text-slate-900">Editar meme</h1>
            <p class="text-sm md:text-base text-slate-600">
                Ajusta el contenido o la explicación de tu meme. Los cambios se aplicarán a partir de ahora.
            </p>
        </div>

        <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 md:p-7 mt-4">
            <form method="POST" action="/memes/{{ $meme->id }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="meme_url" class="block text-xs font-semibold tracking-wide text-slate-700 uppercase mb-2">Meme</label>
                    <textarea
                        name="meme_url"
                        id="meme_url"
                        placeholder="Escribe una URL de imagen o un texto para el meme"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder-slate-400 text-sm resize-none focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none @error('meme_url') border-red-500/70 ring-1 ring-red-500/70 @enderror"
                        rows="3"
                        maxlength="500"
                        required
                    >{{ old('meme_url', $meme->meme_url) }}</textarea>
                    @error('meme_url')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="explicacion" class="block text-xs font-semibold tracking-wide text-slate-700 uppercase mb-2">Explicación</label>
                    <textarea
                        name="explicacion"
                        id="explicacion"
                        placeholder="Explica por qué este meme es relevante para el 8M..."
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder-slate-400 text-sm resize-none focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none @error('explicacion') border-red-500/70 ring-1 ring-red-500/70 @enderror"
                        rows="4"
                        maxlength="1000"
                        required
                    >{{ old('explicacion', $meme->explicacion) }}</textarea>
                    @error('explicacion')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between">
                    <a href="/" class="bg-slate-100 hover:bg-slate-200 text-slate-800 font-medium py-2 px-4 rounded-full text-sm shadow-sm">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-full text-sm shadow-sm transition">
                        Actualizar meme
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
