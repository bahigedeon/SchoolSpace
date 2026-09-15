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
                    <span>Modifier</span>
                </div>

                <h1 class="mt-2 text-2xl font-bold text-slate-900">
                    Modifier l'établissement
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Modifiez les informations de {{ $etablissement->nom }}.
                </p>
            </div>

            <a href="{{ route('admin.etablissements.show', $etablissement) }}"
               class="rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-center text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                ← Voir les détails
            </a>
        </div>

        {{-- Erreurs --}}
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4">
                <p class="font-semibold text-red-800">
                    Vérifiez les informations saisies.
                </p>

                <ul class="mt-2 list-inside list-disc text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulaire --}}
        <form method="POST"
              action="{{ route('admin.etablissements.update', $etablissement) }}"
              class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            @csrf
            @method('PUT')

            <div class="p-6">

                {{-- Identification --}}
                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Identification
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Informations officielles de l'établissement.
                    </p>
                </div>

                <div class="mt-6 grid gap-5 md:grid-cols-2">

                    {{-- Code --}}
                    <div>
                        <label for="code_etablissement"
                               class="block text-sm font-semibold text-slate-700">
                            Code établissement <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="code_etablissement"
                            name="code_etablissement"
                            type="text"
                            value="{{ old('code_etablissement', $etablissement->code_etablissement) }}"
                            required
                            class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                        >

                        @error('code_etablissement')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nom --}}
                    <div>
                        <label for="nom"
                               class="block text-sm font-semibold text-slate-700">
                            Nom de l'établissement <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="nom"
                            name="nom"
                            type="text"
                            value="{{ old('nom', $etablissement->nom) }}"
                            required
                            class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                        >

                        @error('nom')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Type --}}
                    <div>
                        <label for="type"
                               class="block text-sm font-semibold text-slate-700">
                            Type d'établissement <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="type"
                            name="type"
                            required
                            class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                        >
                            <option value="">Sélectionner un type</option>
                            <option value="public"
                                @selected(old('type', $etablissement->type) === 'public')>
                                Public
                            </option>
                            <option value="prive"
                                @selected(old('type', $etablissement->type) === 'prive')>
                                Privé
                            </option>
                            <option value="confessionnel"
                                @selected(old('type', $etablissement->type) === 'confessionnel')>
                                Confessionnel
                            </option>
                            <option value="autre"
                                @selected(old('type', $etablissement->type) === 'autre')>
                                Autre
                            </option>
                        </select>

                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Statut --}}
                    <div>
                        <label for="statut"
                               class="block text-sm font-semibold text-slate-700">
                            Statut <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="statut"
                            name="statut"
                            required
                            class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                        >
                            <option value="">Sélectionner un statut</option>
                            <option value="actif"
                                @selected(old('statut', $etablissement->statut) === 'actif')>
                                Actif
                            </option>
                            <option value="inactif"
                                @selected(old('statut', $etablissement->statut) === 'inactif')>
                                Inactif
                            </option>
                        </select>

                        @error('statut')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Enseignement --}}
                    <div class="md:col-span-2">
                        <label for="enseignement"
                               class="block text-sm font-semibold text-slate-700">
                            Enseignement
                        </label>

                        <input
                            id="enseignement"
                            name="enseignement"
                            type="text"
                            value="{{ old('enseignement', $etablissement->enseignement) }}"
                            class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                        >
                    </div>

                </div>

                {{-- Localisation --}}
                <div class="mt-10 border-t border-slate-200 pt-8">

                    <h2 class="text-lg font-bold text-slate-900">
                        Localisation
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Situation géographique et administrative.
                    </p>

                    <div class="mt-6 grid gap-5 md:grid-cols-2">

                        <div class="md:col-span-2">
                            <label for="adresse"
                                   class="block text-sm font-semibold text-slate-700">
                                Adresse
                            </label>

                            <input
                                id="adresse"
                                name="adresse"
                                type="text"
                                value="{{ old('adresse', $etablissement->adresse) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                            >
                        </div>

                        <div>
                            <label for="ville"
                                   class="block text-sm font-semibold text-slate-700">
                                Ville
                            </label>

                            <input
                                id="ville"
                                name="ville"
                                type="text"
                                value="{{ old('ville', $etablissement->ville) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                            >
                        </div>

                        <div>
                            <label for="commune"
                                   class="block text-sm font-semibold text-slate-700">
                                Commune
                            </label>

                            <input
                                id="commune"
                                name="commune"
                                type="text"
                                value="{{ old('commune', $etablissement->commune) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                            >
                        </div>

                        <div>
                            <label for="district"
                                   class="block text-sm font-semibold text-slate-700">
                                District
                            </label>

                            <input
                                id="district"
                                name="district"
                                type="text"
                                value="{{ old('district', $etablissement->district) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                            >
                        </div>

                        <div>
                            <label for="region"
                                   class="block text-sm font-semibold text-slate-700">
                                Région
                            </label>

                            <input
                                id="region"
                                name="region"
                                type="text"
                                value="{{ old('region', $etablissement->region) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                            >
                        </div>

                        <div>
                            <label for="drena"
                                   class="block text-sm font-semibold text-slate-700">
                                DRENA
                            </label>

                            <input
                                id="drena"
                                name="drena"
                                type="text"
                                value="{{ old('drena', $etablissement->drena) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                            >
                        </div>

                        <div>
                            <label for="iepp"
                                   class="block text-sm font-semibold text-slate-700">
                                IEPP
                            </label>

                            <input
                                id="iepp"
                                name="iepp"
                                type="text"
                                value="{{ old('iepp', $etablissement->iepp) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                            >
                        </div>

                    </div>
                </div>

                {{-- Coordonnées --}}
                <div class="mt-10 border-t border-slate-200 pt-8">

                    <h2 class="text-lg font-bold text-slate-900">
                        Coordonnées
                    </h2>

                    <div class="mt-6 grid gap-5 md:grid-cols-2">

                        <div>
                            <label for="telephone"
                                   class="block text-sm font-semibold text-slate-700">
                                Téléphone
                            </label>

                            <input
                                id="telephone"
                                name="telephone"
                                type="text"
                                value="{{ old('telephone', $etablissement->telephone) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                            >
                        </div>

                        <div>
                            <label for="email"
                                   class="block text-sm font-semibold text-slate-700">
                                Adresse e-mail
                            </label>

                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email', $etablissement->email) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                            >
                        </div>

                        <div>
                            <label for="date_creation"
                                   class="block text-sm font-semibold text-slate-700">
                                Date de création
                            </label>

                            <input
                                id="date_creation"
                                name="date_creation"
                                type="date"
                                value="{{ old('date_creation', $etablissement->date_creation ? \Carbon\Carbon::parse($etablissement->date_creation)->format('Y-m-d') : '') }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                            >
                        </div>

                    </div>
                </div>

            </div>

            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:justify-end">

                <a href="{{ route('admin.etablissements.show', $etablissement) }}"
                   class="rounded-xl border border-slate-300 bg-white px-6 py-3 text-center text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Annuler
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-slate-900 px-7 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">
                    Enregistrer les modifications
                </button>

            </div>

        </form>

    </div>
</x-app-layout>
