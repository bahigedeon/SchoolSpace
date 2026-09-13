<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="text-2xl font-bold text-slate-800">
                Tableau de bord
            </h2>
            <p class="text-sm text-slate-500">
                Vue générale de la plateforme SchoolSpace CI
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">

        {{-- Message d'accueil --}}
        <div class="rounded-2xl bg-slate-900 p-6 text-white shadow-lg">
            <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
                <div>
                    <p class="text-sm text-slate-300">
                        Administration générale
                    </p>

                    <h1 class="mt-1 text-2xl font-bold">
                        Bonjour {{ auth()->user()->prenom ?: auth()->user()->name }} 👋
                    </h1>

                    <p class="mt-2 max-w-2xl text-sm text-slate-300">
                        Gérez les établissements, les salles, les classes,
                        les enseignants et l'organisation scolaire depuis votre espace.
                    </p>
                </div>

                <a href="{{ route('admin.etablissements.create') }}"
                   class="inline-flex items-center justify-center rounded-xl bg-white px-5 py-3 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-100">
                    + Ajouter un établissement
                </a>
            </div>
        </div>

        {{-- Statistiques --}}
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Établissements --}}
            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Établissements
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ $statistiques['etablissements'] }}
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-2xl">
                        🏫
                    </div>
                </div>

                <a href="{{ route('admin.etablissements.index') }}"
                   class="mt-4 inline-block text-sm font-medium text-blue-600 hover:text-blue-800">
                    Voir les établissements →
                </a>
            </div>

            {{-- Salles --}}
            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Salles
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ $statistiques['salles'] }}
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-2xl">
                        🚪
                    </div>
                </div>

                <p class="mt-4 text-sm text-slate-500">
                    {{ $sallesDisponibles }} salle(s) disponible(s)
                </p>
            </div>

            {{-- Classes --}}
            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Classes
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ $statistiques['classes'] }}
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-2xl">
                        📚
                    </div>
                </div>

                <p class="mt-4 text-sm text-slate-500">
                    Classes enregistrées
                </p>
            </div>

            {{-- Élèves --}}
            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Élèves
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ $statistiques['eleves'] }}
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-2xl">
                        🎓
                    </div>
                </div>

                <p class="mt-4 text-sm text-slate-500">
                    Élèves enregistrés
                </p>
            </div>

        </div>

        {{-- Deuxième ligne statistiques --}}
        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm font-medium text-slate-500">
                    Professeurs
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $statistiques['professeurs'] }}
                </p>

                <p class="mt-2 text-sm text-slate-500">
                    Enseignants enregistrés
                </p>
            </div>

            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm font-medium text-slate-500">
                    Utilisateurs
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $statistiques['utilisateurs'] }}
                </p>

                <p class="mt-2 text-sm text-slate-500">
                    Comptes de la plateforme
                </p>
            </div>

            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm font-medium text-slate-500">
                    Cours
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $statistiques['cours'] }}
                </p>

                <p class="mt-2 text-sm text-slate-500">
                    Cours programmés
                </p>
            </div>

        </div>

        {{-- Occupation des salles + classes surchargées --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

            {{-- Occupation --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">
                            Occupation des salles
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Utilisation actuelle des salles enregistrées.
                        </p>
                    </div>

                    <span class="text-2xl font-bold text-slate-900">
                        {{ $tauxOccupation }}%
                    </span>
                </div>

                <div class="mt-6 h-4 overflow-hidden rounded-full bg-slate-100">
                    <div
                        class="h-full rounded-full bg-slate-800 transition-all duration-700"
                        style="width: {{ $tauxOccupation }}%"
                    ></div>
                </div>

                <div class="mt-4 flex justify-between text-sm">
                    <span class="text-slate-500">
                        {{ $sallesOccupees }} occupée(s)
                    </span>

                    <span class="font-medium text-emerald-600">
                        {{ $sallesDisponibles }} disponible(s)
                    </span>
                </div>

            </div>

            {{-- Classes surchargées --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">
                            Classes en surcharge
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Vérification de l'effectif par rapport à la capacité.
                        </p>
                    </div>

                    <span class="rounded-full bg-red-50 px-3 py-1 text-sm font-bold text-red-600">
                        {{ $classesSurchargees->count() }}
                    </span>
                </div>

                <div class="mt-5 space-y-3">

                    @forelse($classesSurchargees->take(4) as $classe)

                        <div class="flex items-center justify-between rounded-xl bg-red-50 p-4">

                            <div>
                                <p class="font-semibold text-slate-900">
                                    {{ $classe->nom }}
                                </p>

                                <p class="text-xs text-slate-500">
                                    Salle :
                                    {{ $classe->sallePrincipale?->nom ?? 'Non affectée' }}
                                </p>
                            </div>

                            <div class="text-right">
                                <p class="font-bold text-red-600">
                                    {{ $classe->effectif }}
                                </p>

                                <p class="text-xs text-slate-500">
                                    / {{ $classe->sallePrincipale?->capacite ?? 0 }} places
                                </p>
                            </div>

                        </div>

                    @empty

                        <div class="rounded-xl bg-emerald-50 p-5 text-center">
                            <p class="font-semibold text-emerald-700">
                                ✓ Aucune classe en surcharge
                            </p>

                            <p class="mt-1 text-sm text-emerald-600">
                                La capacité des salles est actuellement respectée.
                            </p>
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

        {{-- Établissements récents + utilisateurs récents --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

            {{-- Établissements --}}
            <div class="rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

                <div class="flex items-center justify-between border-b border-slate-100 p-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">
                            Établissements récents
                        </h3>

                        <p class="text-sm text-slate-500">
                            Les derniers établissements ajoutés.
                        </p>
                    </div>

                    <a href="{{ route('admin.etablissements.index') }}"
                       class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                        Tout voir
                    </a>
                </div>

                <div class="divide-y divide-slate-100">

                    @forelse($etablissementsRecents as $etablissement)

                        <div class="flex items-center justify-between p-5">

                            <div>
                                <p class="font-semibold text-slate-900">
                                    {{ $etablissement->nom }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    Code :
                                    {{ $etablissement->code_etablissement }}
                                </p>
                            </div>

                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                                {{ $etablissement->ville ?? 'Non renseignée' }}
                            </span>

                        </div>

                    @empty

                        <div class="p-8 text-center">
                            <p class="text-slate-500">
                                Aucun établissement enregistré.
                            </p>

                            <a href="{{ route('admin.etablissements.create') }}"
                               class="mt-3 inline-block text-sm font-semibold text-blue-600 hover:text-blue-800">
                                Ajouter le premier établissement →
                            </a>
                        </div>

                    @endforelse

                </div>

            </div>

            {{-- Utilisateurs --}}
            <div class="rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

                <div class="border-b border-slate-100 p-6">
                    <h3 class="text-lg font-bold text-slate-900">
                        Utilisateurs récents
                    </h3>

                    <p class="text-sm text-slate-500">
                        Derniers comptes créés sur SchoolSpace CI.
                    </p>
                </div>

                <div class="divide-y divide-slate-100">

                    @forelse($utilisateursRecents as $utilisateur)

                        <div class="flex items-center justify-between p-5">

                            <div>
                                <p class="font-semibold text-slate-900">
                                    {{ $utilisateur->prenom }}
                                    {{ $utilisateur->nom }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $utilisateur->email }}
                                </p>
                            </div>

                            <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-600">
                                {{ $utilisateur->role?->nom ?? 'Utilisateur' }}
                            </span>

                        </div>

                    @empty

                        <div class="p-8 text-center text-slate-500">
                            Aucun utilisateur récent.
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>
</x-app-layout>