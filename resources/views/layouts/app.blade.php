<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SchoolSpace CI') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-800 antialiased">

<div
    x-data="{ sidebarOpen: false }"
    class="min-h-screen"
>

    {{-- MOBILE OVERLAY --}}
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-slate-900/50 lg:hidden"
        style="display: none;"
    ></div>


    {{-- SIDEBAR --}}
    <aside
        class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col bg-slate-950 text-white shadow-2xl transition-transform duration-300 lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >

        {{-- LOGO --}}
        <div class="flex h-20 items-center justify-between border-b border-white/10 px-6">

            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-600 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6"/>
                    </svg>
                </div>

                <div>
                    <div class="text-lg font-bold tracking-tight">
                        SchoolSpace
                    </div>

                    <div class="text-xs text-indigo-300">
                        CI • Gestion scolaire
                    </div>
                </div>

            </a>

            {{-- CLOSE MOBILE --}}
            <button
                @click="sidebarOpen = false"
                class="rounded-lg p-2 text-slate-400 hover:bg-white/10 hover:text-white lg:hidden"
            >
                ✕
            </button>

        </div>


        {{-- USER MINI PROFILE --}}
        <div class="border-b border-white/10 p-5">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-indigo-500 font-bold">
                    {{ strtoupper(substr(auth()->user()->prenom ?? auth()->user()->name, 0, 1)) }}
                </div>

                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold">
                        {{ auth()->user()->prenom ?? auth()->user()->name }}
                        {{ auth()->user()->nom ?? '' }}
                    </p>

                    <p class="truncate text-xs text-slate-400">
                        {{ auth()->user()->role?->nom ?? 'Utilisateur' }}
                    </p>
                </div>

            </div>

        </div>


        {{-- NAVIGATION --}}
        <nav class="flex-1 overflow-y-auto px-4 py-5">

            {{-- PRINCIPAL --}}
            <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-widest text-slate-500">
                Principal
            </p>

            <div class="space-y-1">

                {{-- DASHBOARD --}}
                <a href="{{ route('dashboard') }}"
                   class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                   {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">

                    <svg class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"/>
                    </svg>

                    <span>Tableau de bord</span>
                </a>


                {{-- ADMIN --}}
                @if(auth()->user()->role?->nom === 'admin')

                    <a href="{{ route('admin.dashboard') }}"
                       class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                       {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">

                        <svg class="h-5 w-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 0h6M5 10h14M7 6h10a2 2 0 012 2v12H5V8a2 2 0 012-2z"/>
                        </svg>

                        <span>Administration</span>
                    </a>

                @endif

            </div>


            {{-- GESTION SCOLAIRE --}}
            <p class="mb-3 mt-8 px-3 text-[11px] font-semibold uppercase tracking-widest text-slate-500">
                Gestion scolaire
            </p>

            <div class="space-y-1">

                {{-- ETABLISSEMENTS --}}
                @if(auth()->user()->role?->nom === 'admin')

                    <a href="{{ route('admin.etablissements.index') }}"
                       class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                       {{ request()->routeIs('admin.etablissements.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">

                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-500/10 text-blue-400">
                            🏫
                        </span>

                        <span>Établissements</span>
                    </a>

                @endif


                {{-- DIRECTEURS --}}
                <a href="#"
                   class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/10 hover:text-white">

                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-500/10">
                        👨‍💼
                    </span>

                    <span>Directeurs</span>

                    <span class="ml-auto rounded-full bg-slate-800 px-2 py-0.5 text-[10px]">
                        Bientôt
                    </span>
                </a>


                {{-- PROFESSEURS --}}
                <a href="#"
                   class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/10 hover:text-white">

                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-500/10">
                        👨‍🏫
                    </span>

                    <span>Professeurs</span>
                </a>


                {{-- EDUCATEURS --}}
                <a href="#"
                   class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/10 hover:text-white">

                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-500/10">
                        🧑‍🏫
                    </span>

                    <span>Éducateurs</span>
                </a>


                {{-- ELEVES --}}
                <a href="#"
                   class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/10 hover:text-white">

                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-cyan-500/10">
                        🎓
                    </span>

                    <span>Élèves</span>
                </a>


                {{-- CLASSES --}}
                <a href="#"
                   class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/10 hover:text-white">

                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-pink-500/10">
                        📚
                    </span>

                    <span>Classes</span>
                </a>


                {{-- SALLES --}}
                <a href="#"
                   class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/10 hover:text-white">

                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-yellow-500/10">
                        🚪
                    </span>

                    <span>Salles</span>
                </a>


                {{-- MATIERES --}}
                <a href="#"
                   class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/10 hover:text-white">

                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-500/10">
                        📖
                    </span>

                    <span>Matières</span>
                </a>


                {{-- EMPLOI DU TEMPS --}}
                <a href="#"
                   class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/10 hover:text-white">

                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-500/10">
                        🗓️
                    </span>

                    <span>Emploi du temps</span>
                </a>

            </div>


            {{-- ANALYSE --}}
            <p class="mb-3 mt-8 px-3 text-[11px] font-semibold uppercase tracking-widest text-slate-500">
                Analyse
            </p>

            <div class="space-y-1">

                <a href="#"
                   class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/10 hover:text-white">

                    <span>⚠️</span>
                    <span>Conflits</span>

                    <span class="ml-auto flex h-5 min-w-5 items-center justify-center rounded-full bg-red-500 px-1 text-[10px] font-bold text-white">
                        0
                    </span>
                </a>


                <a href="#"
                   class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/10 hover:text-white">

                    <span>🔔</span>
                    <span>Notifications</span>
                </a>


                <a href="#"
                   class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/10 hover:text-white">

                    <span>📊</span>
                    <span>Rapports</span>
                </a>

            </div>

        </nav>


        {{-- SIDEBAR FOOTER --}}
        <div class="border-t border-white/10 p-4">

            <a href="{{ route('profile.edit') }}"
               class="mb-2 flex items-center gap-3 rounded-xl px-3 py-3 text-sm text-slate-300 hover:bg-white/10 hover:text-white">

                <span>⚙️</span>
                <span>Mon profil</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm text-red-300 hover:bg-red-500/10 hover:text-red-200">

                    <span>↪</span>
                    <span>Déconnexion</span>

                </button>
            </form>

        </div>

    </aside>


    {{-- MAIN CONTENT --}}
    <div class="lg:pl-72">

        {{-- TOPBAR --}}
        <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur">

            <div class="flex h-20 items-center justify-between px-4 sm:px-6 lg:px-8">

                {{-- MOBILE MENU --}}
                <button
                    @click="sidebarOpen = true"
                    class="rounded-xl p-2 text-slate-600 hover:bg-slate-100 lg:hidden"
                >
                    ☰
                </button>


                {{-- SEARCH --}}
                <div class="hidden md:flex md:flex-1 md:max-w-xl">

                    <div class="relative w-full">

                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            🔍
                        </span>

                        <input
                            type="text"
                            placeholder="Rechercher dans SchoolSpace..."
                            class="w-full rounded-xl border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                    </div>

                </div>


                {{-- RIGHT --}}
                <div class="ml-auto flex items-center gap-3">

                    {{-- NOTIFICATION --}}
                    <button class="relative flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 bg-white hover:bg-slate-50">
                        🔔

                        <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-red-500"></span>
                    </button>


                    {{-- USER --}}
                    <div class="hidden items-center gap-3 border-l border-slate-200 pl-4 sm:flex">

                        <div class="text-right">

                            <p class="text-sm font-semibold text-slate-800">
                                {{ auth()->user()->prenom ?? auth()->user()->name }}
                            </p>

                            <p class="text-xs capitalize text-slate-500">
                                {{ auth()->user()->role?->nom ?? 'Utilisateur' }}
                            </p>

                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-indigo-600 font-bold text-white">
                            {{ strtoupper(substr(auth()->user()->prenom ?? auth()->user()->name, 0, 1)) }}
                        </div>

                    </div>

                </div>

            </div>

        </header>


        {{-- PAGE HEADER --}}
        @isset($header)
            <div class="border-b border-slate-200 bg-white">
                <div class="px-4 py-5 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </div>
        @endisset


        {{-- PAGE CONTENT --}}
        <main>
            {{ $slot }}
        </main>

    </div>

</div>

</body>
</html>