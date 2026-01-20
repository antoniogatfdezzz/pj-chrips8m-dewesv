@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Paginación" class="mt-6 flex justify-center">
        <ul class="inline-flex items-center gap-1">
            {{-- Enlace a página anterior --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full border border-slate-200 bg-slate-50 text-slate-400 cursor-default select-none">
                        Anterior
                    </span>
                </li>
            @else
                <li>
                    <a
                        href="{{ $paginator->previousPageUrl() }}"
                        rel="prev"
                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full border border-slate-200 bg-white text-slate-700 hover:bg-purple-50 hover:text-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-1 transition"
                    >
                        Anterior
                    </a>
                </li>
            @endif

            {{-- Números de página --}}
            @foreach ($elements as $element)
                {{-- Puntos suspensivos --}}
                @if (is_string($element))
                    <li>
                        <span class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full text-slate-400 select-none">{{ $element }}</span>
                    </li>
                @endif

                {{-- Matriz de enlaces de páginas --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-full border border-purple-600 bg-purple-600 text-white shadow-sm select-none">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a
                                    href="{{ $url }}"
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full border border-slate-200 bg-white text-slate-700 hover:bg-purple-50 hover:text-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-1 transition"
                                >
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Enlace a página siguiente --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a
                        href="{{ $paginator->nextPageUrl() }}"
                        rel="next"
                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full border border-slate-200 bg-white text-slate-700 hover:bg-purple-50 hover:text-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-1 transition"
                    >
                        Siguiente
                    </a>
                </li>
            @else
                <li>
                    <span class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full border border-slate-200 bg-slate-50 text-slate-400 cursor-default select-none">
                        Siguiente
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
