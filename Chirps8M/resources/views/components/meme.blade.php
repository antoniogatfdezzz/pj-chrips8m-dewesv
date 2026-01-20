@props(['meme'])

<div class="w-full max-w-xl perspective">
    <div x-data="{ flipped: false }" class="relative w-full min-h-[34rem] h-auto"
         :class="flipped ? 'rotate-y-180' : ''"
         @click.away="flipped = false"
         style="transform-style: preserve-3d; transition: transform 0.6s;">

        {{-- FRONT --}}
        <div class="absolute w-full h-full backface-hidden flex flex-col bg-white border border-slate-200 shadow-md rounded-2xl p-5">

            {{-- Avatar, nombre y acciones --}}
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    @if($meme->user)
                            <img src="https://avatars.laravel.cloud/{{ urlencode($meme->user->email) }}"
                                alt="{{ $meme->user->name }}'s avatar" class="w-12 h-12 rounded-full ring-2 ring-purple-400/60" />
                        <div class="flex flex-col">
                            <span class="font-semibold text-slate-900">{{ $meme->user->name }}</span>
                            <div class="flex items-center gap-1">
                                <span class="text-xs text-slate-500">{{ $meme->fecha_subida->diffForHumans() }}</span>
                                @if ($meme->updated_at->gt($meme->created_at->addSeconds(5)))
                                    <span class="text-slate-400">·</span>
                                    <span class="text-xs text-slate-500 italic">editado</span>
                                @endif
                            </div>
                        </div>
                    @else
                        <img src="https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth"
                            alt="Usuario anónimo" class="w-12 h-12 rounded-full ring-2 ring-slate-300/80" />
                        <div class="flex flex-col">
                            <span class="font-semibold text-slate-900">Anónimo</span>
                            <div class="flex items-center gap-1">
                                <span class="text-xs text-slate-500">{{ $meme->fecha_subida->diffForHumans() }}</span>
                                @if ($meme->updated_at->gt($meme->created_at->addSeconds(5)))
                                    <span class="text-slate-400">·</span>
                                    <span class="text-xs text-slate-500 italic">editado</span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Botones de acción --}}
                {{-- TODO: Envolver en @can('update', $meme) (ver guía paso 8) --}}
                    @can('update', $meme)
                        <div class="flex items-center gap-2">
                            <a
                                href="/memes/{{ $meme->id }}/edit"
                                class="inline-flex items-center gap-1 rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-[11px] font-medium text-slate-800 hover:bg-slate-100 hover:border-slate-300 transition">
                                Editar
                            </a>
                            <form method="POST" action="/memes/{{ $meme->id }}">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-1 rounded-full border border-red-200 bg-red-50 px-3 py-1 text-[11px] font-medium text-red-700 hover:bg-red-100 hover:border-red-300 transition">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    @endcan
            </div>

            {{-- Meme --}}
            <div class="flex-1 flex flex-col items-center justify-center overflow-hidden">
                @php
                    $isUrl = \Illuminate\Support\Str::startsWith($meme->meme_url, ['http://', 'https://']);
                @endphp

                @if ($isUrl)
                    <img src="{{ $meme->meme_url }}" alt="Meme" class="rounded-xl w-full h-auto max-h-[70vh] object-cover border border-slate-200 shadow-md">
                @else
                    <p class="text-xl md:text-2xl text-center text-slate-900 break-words whitespace-pre-line">
                        {{ $meme->meme_url }}
                    </p>
                @endif
            </div>

            {{-- Botón para ver explicación --}}
                <button @click.stop="flipped = true"
                    class="mt-4 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-full shadow-md mx-auto block text-sm">
                Ver explicación
            </button>

        </div>

        {{-- BACK --}}
        <div class="absolute w-full h-full backface-hidden rotate-y-180 flex flex-col bg-white border border-slate-200 shadow-md rounded-2xl p-5 justify-between">
            {{-- Explicación centrada --}}
            <div class="flex-1 flex items-center justify-center text-center">
                <p class="text-slate-900 text-lg leading-relaxed">{{ $meme->explicacion }}</p>
            </div>

            {{-- Botón Volver abajo --}}
            <div class="flex justify-center">
                <button @click.stop="flipped = false"
                    class="bg-slate-100 hover:bg-slate-200 text-slate-800 font-medium py-2 px-5 rounded-full text-sm shadow-sm">
                    Volver al meme
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Tailwind necesario para 3D --}}
<style>
.perspective {
    perspective: 1000px;
}
.rotate-y-180 {
    transform: rotateY(180deg);
}
.backface-hidden {
    backface-visibility: hidden;
}
</style>
