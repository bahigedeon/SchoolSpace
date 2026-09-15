<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Établissements
                </h2>

                <p class="text-sm text-slate-500">
                    Gestion des établissements scolaires de SchoolSpace CI
                </p>
            </div>

            <a href="{{ route('admin.etablissements.create') }}"
               class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">
                <span class="mr-2 text-lg">+</span>
                Ajouter un établissement
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">

        {{-- Message de succès --}}
        @if(session('success'))
            <div class="flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
                <span class="text-lg">✓</span>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        {{-- Statistiques rapides --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm text-slate-500">
                    Total établissements
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $etablissements->total() }}
                </p>
            </div>

            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm text-slate-500">
                    Page actuelle
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $etablissements->currentPage() }}
                </p>
            </div>

            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm text-slate-500">
                    Résultats par page
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $etablissements->count() }}
                </p>
            </div>

        </div>

        {{-- Recherche --}}
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">

            <form method="GET"
                  action="{{ route('admin.etablissements.index') }}"
                  class="flex flex-col gap-3 md:flex-row">

                <div class="relative flex-1">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Rechercher par code, nom, ville ou commune..."
                        class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500"
                    >

                </div>

                <button
                    type="submit"
                    class="rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                    🔎 Rechercher
                </button>

                @if(request('search'))
                    <a
                        href="{{ route('admin.etablissements.index') }}"
                        class="rounded-xl border border-slate-300 px-6 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                        Effacer
                    </a>
                @endif

            </form>

        </div>

        {{-- Tableau --}}
        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="border-b border-slate-200 bg-slate-50">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Établissement
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Code officiel
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Localisation
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Type
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($etablissements as $etablissement)

                            <tr class="transition hover:bg-slate-50">

                                {{-- Établissement --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-100 text-xl">
                                            🏫
                                        </div>

                                        <div>

                                            <p class="font-semibold text-slate-900">
                                                {{ $etablissement->nom }}
                                            </p>

                                            @if($etablissement->enseignement)
                                                <p class="mt-1 text-xs text-slate-500">
                                                    {{ $etablissement->enseignement }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                </td>

                                {{-- Code --}}
                                <td class="px-6 py-5">

                                    <span class="inline-flex rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-700">
                                        {{ $etablissement->code_etablissement }}
                                    </span>

                                </td>

                                {{-- Localisation --}}
                                <td class="px-6 py-5">

                                    <p class="text-sm font-medium text-slate-700">
                                        {{ $etablissement->ville ?? 'Non renseignée' }}
                                    </p>

                                    @if($etablissement->commune)
                                        <p class="mt-1 text-xs text-slate-500">
                                            {{ $etablissement->commune }}
                                        </p>
                                    @endif

                                </td>

                                {{-- Type --}}
                                <td class="px-6 py-5">

                                    <span class="rounded-full bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-600">
                                        {{ $etablissement->type ?? 'Non renseigné' }}
                                    </span>

                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-5">

                                    <div class="flex justify-end gap-2">

                                        <a
                                            href="{{ route('admin.etablissements.show', $etablissement) }}"
                                            class="rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100">
                                            Voir
                                        </a>

                                        <a
                                            href="{{ route('admin.etablissements.edit', $etablissement) }}"
                                            class="rounded-lg bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700 transition hover:bg-amber-100">
                                            Modifier
                                        </a>

                                        <form
                                            action="{{ route('admin.etablissements.destroy', $etablissement) }}"
                                            method="POST"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet établissement ? Cette action est irréversible.');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="text-red-600 hover:text-red-800 font-medium"
                                            >
                                                Supprimer
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="px-6 py-16 text-center">

                                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-3xl">
                                        🏫
                                    </div>

                                    <h3 class="mt-5 text-lg font-bold text-slate-800">
                                        Aucun établissement
                                    </h3>

                                    <p class="mt-2 text-sm text-slate-500">
                                        Aucun établissement ne correspond à votre recherche.
                                    </p>

                                    <a
                                        href="{{ route('admin.etablissements.create') }}"
                                        class="mt-5 inline-flex rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-700">
                                        + Ajouter le premier établissement
                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if($etablissements->hasPages())

                <div class="border-t border-slate-100 px-6 py-4">
                    {{ $etablissements->links() }}
                </div>

            @endif

        </div>

    </div>

</x-app-layout>