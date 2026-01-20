@props(['chirp'])

<div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-4 md:p-5">
    <div class="flex gap-3">
            @if($chirp->user)
                <div class="shrink-0">
                    <img src="https://avatars.laravel.cloud/{{ urlencode($chirp->user->email) }}"
                        alt="{{ $chirp->user->name }}'s avatar"
                        class="h-10 w-10 rounded-full ring-2 ring-purple-400/50" />
                </div>
            @else
                <div class="shrink-0">
                    <img src="https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth"
                         alt="Anonymous User"
                         class="h-10 w-10 rounded-full ring-2 ring-slate-300/80" />
                </div>
            @endif

            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-slate-900">{{ $chirp->user ? $chirp->user->name : 'Anonymous' }}</span>
                    <span class="text-slate-400">·</span>
                    <span class="text-xs text-slate-500">{{ $chirp->created_at->diffForHumans() }}</span>
                </div>

                <p class="mt-2 text-sm text-slate-900 leading-relaxed break-words">
                    {{ $chirp->message }}
                </p>
            </div>
        </div>
    </div>
</div>
