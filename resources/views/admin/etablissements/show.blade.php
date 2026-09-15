<x-app-layout>
    <div class="space-y-6">

        {{-- En-tête --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('admin.etablissements.index') }}"
                       class="hover:text-slate-900">
                        Établissements
                    </a>
                    <span>/</span>
                    <span>Détails</span>
                </div>

                <h1 class="mt-2 text-2xl font-bold text-slate-900">
                    {{ $etablissement->nom }}
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Informations détaillées de l'établissement
                </p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.etablissements.index') }}"
                   class="rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    ← Retour
                </a>

                <a href="{{ route('admin.etablissements.edit', $etablissement) }}"
                   class="rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">
                    Modifier
                </a>
            </div>
        </div>

        {{-- Carte principale --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- Bandeau --}}
            <div class="bg-slate-900 px-6 py-6 text-white">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-300">
                            Établissement scolaire
                        </p>

                        <h2 class="mt-1 text-xl font-bold">
                            {{ $etablissement->nom }}
                        </h2>
                    </div>

                    <div class="rounded-xl bg-white/10 px-4 py-3">
                        <p class="text-xs text-slate-300">
                            Code établissement
                        </p>

                        <p class="mt-1 text-lg font-bold">
                            {{ $etablissement->code_etablissement }}
                        </p>
                    </div>

                </div>
            </div>

            <div class="p-6">

                {{-- Identification --}}
                <div>
                    <h3 class="text-lg font-bold text-slate-900">
                        Identification
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Informations officielles de l'établissement.
                    </p>
                </div>

                <div class="mt-5 grid gap-5 md:grid-cols-2 lg:grid-cols-3">

                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Code établissement
                        </p>

                        <p class="mt-2 font-semibold text-slate-900">
                            {{ $etablissement->code_etablissement ?: 'Non renseigné' }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Nom
                        </p>

                        <p class="mt-2 font-semibold text-slate-900">
                            {{ $etablissement->nom ?: 'Non renseigné' }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Type
                        </p>

                        <p class="mt-2 font-semibold text-slate-900">
                            {{ $etablissement->type ?: 'Non renseigné' }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Statut
                        </p>

                        <p class="mt-2 font-semibold text-slate-900">
                            {{ $etablissement->statut ?: 'Non renseigné' }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Enseignement
                        </p>

                        <p class="mt-2 font-semibold text-slate-900">
                            {{ $etablissement->enseignement ?: 'Non renseigné' }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Date de création
                        </p>

                        <p class="mt-2 font-semibold text-slate-900">
                            {{ $etablissement->date_creation ? \Carbon\Carbon::parse($etablissement->date_creation)->format('d/m/Y') : 'Non renseignée' }}
                        </p>
                    </div>

                </div>

                {{-- Localisation --}}
                <div class="mt-10 border-t border-slate-200 pt-8">

                    <h3 class="text-lg font-bold text-slate-900">
                        Localisation
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Situation géographique et administrative.
                    </p>

                    <div class="mt-5 grid gap-5 md:grid-cols-2 lg:grid-cols-3">

                        <div class="rounded-xl bg-slate-50 p-4 md:col-span-2">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                                Adresse
                            </p>

                            <p class="mt-2 font-semibold text-slate-900">
                                {{ $etablissement->adresse ?: 'Non renseignée' }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                                Ville
                            </p>

                            <p class="mt-2 font-semibold text-slate-900">
                                {{ $etablissement->ville ?: 'Non renseignée' }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                                Commune
                            </p>

                            <p class="mt-2 font-semibold text-slate-900">
                                {{ $etablissement->commune ?: 'Non renseignée' }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                                District
                            </p>

                            <p class="mt-2 font-semibold text-slate-900">
                                {{ $etablissement->district ?: 'Non renseigné' }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                                Région
                            </p>

                            <p class="mt-2 font-semibold text-slate-900">
                                {{ $etablissement->region ?: 'Non renseignée' }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                                DRENA
                            </p>

                            <p class="mt-2 font-semibold text-slate-900">
                                {{ $etablissement->drena ?: 'Non renseignée' }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                                IEPP
                            </p>

                            <p class="mt-2 font-semibold text-slate-900">
                                {{ $etablissement->iepp ?: 'Non renseignée' }}
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Coordonnées --}}
                <div class="mt-10 border-t border-slate-200 pt-8">

                    <h3 class="text-lg font-bold text-slate-900">
                        Coordonnées
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Moyens de contact de l'établissement.
                    </p>

                    <div class="mt-5 grid gap-5 md:grid-cols-2">

                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                                Téléphone
                            </p>

                            <p class="mt-2 font-semibold text-slate-900">
                                {{ $etablissement->telephone ?: 'Non renseigné' }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                                Adresse e-mail
                            </p>

                            @if($etablissement->email)
                                <a href="mailto:{{ $etablissement->email }}"
                                   class="mt-2 block font-semibold text-slate-900 hover:underline">
                                    {{ $etablissement->email }}
                                </a>
                            @else
                                <p class="mt-2 font-semibold text-slate-900">
                                    Non renseignée
                                </p>
                            @endif
                        </div>

                    </div>
                </div>

                {{-- Actions --}}
                <div class="mt-10 flex flex-col gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">

                    <a href="{{ route('admin.etablissements.index') }}"
                       class="rounded-xl border border-slate-300 bg-white px-6 py-3 text-center text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Retour à la liste
                    </a>

                    <a href="{{ route('admin.etablissements.edit', $etablissement) }}"
                       class="rounded-xl bg-slate-900 px-6 py-3 text-center text-sm font-semibold text-white transition hover:bg-slate-700">
                        Modifier l'établissement
                    </a>

                </div>

            </div>
        </div>

    </div>
</x-app-layout>
