<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="text-2xl font-bold text-slate-800">
                Établissements
            </h2>

            <p class="text-sm text-slate-500">
                Gérez les établissements enregistrés sur SchoolSpace CI.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">

        {{-- Message succès --}}
        @if(session('success'))
            <div class="rounded-xl bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
                ✓ {{ session('success') }}
            </div>
        @endif

        {{-- Erreurs --}}
        @if($errors->any())
            <div class="rounded-xl bg-red-50 px-5 py-4 text-sm text-red-700">
                <p class="font-semibold">Veuillez corriger les erreurs suivantes :</p>

                <ul class="mt-2 list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Barre supérieure --}}
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                {{-- Recherche --}}
                <form method="GET"
                      action="{{ route('admin.etablissements.index') }}"
                      class="flex flex-1 gap-3">

                    <div class="relative flex-1">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Rechercher par code, nom, ville ou commune..."
                            aria-label="Rechercher un établissement"
                            class="w-full rounded-xl border-slate-300 pl-4 pr-4 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500"
                        >
                    </div>

                    <button
                        type="submit"
                        aria-label="Lancer la recherche"
                        class="rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">
                        Rechercher
                    </button>

                    @if(request('search'))
                        <a
                            href="{{ route('admin.etablissements.index') }}"
                            class="rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                            Réinitialiser
                        </a>
                    @endif

                </form>

                {{-- Ajouter --}}
                <a
                    href="{{ route('admin.etablissements.create') }}"
                    aria-label="Ajouter un établissement"
                    class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">
                    + Ajouter un établissement
                </a>

            </div>

        </div>

        {{-- Tableau --}}
        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Code officiel
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Établissement
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

                                {{-- Code --}}
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-700">
                                        {{ $etablissement->code_etablissement }}
                                    </span>
                                </td>

                                {{-- Nom --}}
                                <td class="px-6 py-4">
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
                                </td>

                                {{-- Localisation --}}
                                <td class="px-6 py-4">
                                    <p class="text-sm text-slate-700">
                                        {{ $etablissement->ville ?? '—' }}
                                    </p>

                                    @if($etablissement->commune)
                                        <p class="text-xs text-slate-500">
                                            {{ $etablissement->commune }}
                                        </p>
                                    @endif
                                </td>

                                {{-- Type --}}
                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                                        {{ $etablissement->type ?? 'Non renseigné' }}
                                    </span>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap justify-end gap-2">

                                        {{-- Voir --}}
                                        <a
                                            href="{{ route('admin.etablissements.show', $etablissement) }}"
                                            aria-label="Voir {{ $etablissement->nom }}"
                                            class="inline-flex whitespace-nowrap rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100">
                                            Voir
                                        </a>

                                        {{-- Modifier --}}
                                        <a
                                            href="{{ route('admin.etablissements.edit', $etablissement) }}"
                                            aria-label="Modifier {{ $etablissement->nom }}"
                                            class="inline-flex whitespace-nowrap rounded-lg bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700 transition hover:bg-amber-100">
                                            Modifier
                                        </a>

                                        {{-- Supprimer --}}
                                        <form
                                            action="{{ route('admin.etablissements.destroy', $etablissement) }}"
                                            method="POST"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer cet établissement ?');">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                aria-label="Supprimer {{ $etablissement->nom }}"
                                                class="inline-flex whitespace-nowrap rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100">
                                                Supprimer
                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">

                                    <div class="text-4xl">
                                        🏫
                                    </div>

                                    <h3 class="mt-4 text-lg font-bold text-slate-800">
                                        Aucun établissement trouvé
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Commencez par ajouter un établissement.
                                    </p>

                                    <a
                                        href="{{ route('admin.etablissements.create') }}"
                                        class="mt-5 inline-flex rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-slate-700">
                                        + Ajouter un établissement
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

        {{-- Résumé --}}
        <div class="text-sm text-slate-500">
            {{ $etablissements->total() }}
            établissement(s) enregistré(s).
        </div>

    </div>

</x-app-layout>