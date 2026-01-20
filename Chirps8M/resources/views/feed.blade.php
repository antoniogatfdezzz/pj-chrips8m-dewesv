<x-layout>
    <x-slot:title>
        Chirps-8M
    </x-slot:title>

    <div class="max-w-3xl mx-auto">
        <div class="mt-4 mb-8 flex flex-col gap-2">
            <h1 class="text-3xl md:text-4xl font-semibold tracking-tight text-slate-900">Memes sobre mujeres - 8M</h1>
            <p class="text-sm md:text-base text-slate-600 max-w-xl">
                Comparte imágenes, textos, ... hablando mal de las mujeres y desmientelos.
            </p>
        </div>

        <!-- Meme Form -->
        <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 md:p-7">
            <form method="POST" action="/memes">
                @csrf
                <div class="mb-4">
                    <label for="meme_url" class="block text-xs font-semibold tracking-wide text-slate-700 uppercase mb-2">Meme</label>
                    <textarea
                        name="meme_url"
                        id="meme_url"
                        placeholder="Pega una URL de imagen o escribe el texto de tu meme"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder-slate-400 text-sm resize-none focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none @error('meme_url') border-red-500/70 ring-1 ring-red-500/70 @enderror"
                        rows="3"
                        maxlength="500"
                        required
                    >{{ old('meme_url') }}</textarea>
                    @error('meme_url')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="explicacion" class="block text-xs font-semibold tracking-wide text-slate-700 uppercase mb-2">Explicación</label>
                    <textarea
                        name="explicacion"
                        id="explicacion"
                        placeholder="Cuéntanos por qué este meme tiene sentido en el contexto del 8M..."
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder-slate-400 text-sm resize-none focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none @error('explicacion') border-red-500/70 ring-1 ring-red-500/70 @enderror"
                        rows="4"
                        maxlength="1000"
                        required
                    >{{ old('explicacion') }}</textarea>
                    @error('explicacion')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2.5 px-6 rounded-full text-sm shadow-md transition">
                        <span>Publicar meme</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Feed -->
        <div class="space-y-6 mt-8 flex flex-col items-center">
            @forelse ($memes as $meme)
                <x-meme :meme="$meme" />
            @empty
                <div class="mt-10 w-full">
                    <div class="border border-dashed border-slate-300 rounded-2xl p-10 text-center bg-white">
                        <svg class="mx-auto h-10 w-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <p class="mt-4 text-sm md:text-base text-slate-600">Todavía no hay memes publicados.</p>
                        <p class="text-sm text-slate-500 mt-1">Anímate a compartir el primero ✊</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if ($memes instanceof \Illuminate\Pagination\LengthAwarePaginator || $memes instanceof \Illuminate\Pagination\Paginator)
            <div class="mt-6 flex justify-center">
                {{ $memes->links() }}
            </div>
        @endif
    </div>
</x-layout>
