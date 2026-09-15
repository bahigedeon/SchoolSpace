<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Ajouter un établissement
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Enregistrer un nouvel établissement dans SchoolSpace CI
            </p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-6xl">

        {{-- Erreurs --}}
        @if($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">
                <div class="flex gap-3">
                    <span class="text-xl">⚠️</span>

                    <div>
                        <h3 class="font-semibold text-red-800">
                            Impossible d'enregistrer l'établissement
                        </h3>

                        <ul class="mt-2 list-disc pl-5 text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('admin.etablissements.store') }}"
            class="space-y-6">

            @csrf

            {{-- Identification --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

                <div class="border-b border-slate-100 bg-slate-50 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100">
                            🏫
                        </div>

                        <div>
                            <h3 class="font-bold text-slate-800">
                                Identification de l'établissement
                            </h3>

                            <p class="text-sm text-slate-500">
                                Informations officielles
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                    {{-- Code --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Code officiel de l'établissement
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="code_etablissement"
                            value="{{ old('code_etablissement') }}"
                            required
                            placeholder="Ex. 123456789"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm uppercase shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >

                        <p class="mt-2 text-xs text-slate-500">
                            Le code officiel doit correspondre au code reconnu par l'administration.
                        </p>
                    </div>

                    {{-- Nom --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Nom de l'établissement
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="nom"
                            value="{{ old('nom') }}"
                            required
                            placeholder="Ex. Lycée Moderne de Cocody"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >
                    </div>

                    {{-- Type --}}
                    <div>
                        <label for="type" class="mb-2 block text-sm font-semibold text-slate-700">
                            Type d'établissement
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="type"
                            name="type"
                            required
                            class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-slate-900 focus:ring-slate-900">

                            <option value="">Sélectionner un type</option>
                            <option value="public" @selected(old('type') === 'public')>
                                Public
                            </option>
                            <option value="prive" @selected(old('type') === 'prive')>
                                Privé
                            </option>
                            <option value="confessionnel" @selected(old('type') === 'confessionnel')>
                                Confessionnel
                            </option>
                            <option value="autre" @selected(old('type') === 'autre')>
                                Autre
                            </option>
                        </select>

                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Statut --}}
                    <div>
                        <label for="statut" class="mb-2 block text-sm font-semibold text-slate-700">
                            Statut <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="statut"
                            name="statut"
                            required
                            class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-slate-900 focus:ring-slate-900">
                            <option value="">Sélectionner un statut</option>
                            <option value="actif" @selected(old('statut') === 'actif')>
                                Actif
                            </option>
                            <option value="inactif" @selected(old('statut') === 'inactif')>
                                Inactif
                            </option>
                        </select>

                        @error('statut')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Enseignement --}}
                    <div class="md:col-span-2">
                        <label for="enseignement" class="mb-2 block text-sm font-semibold text-slate-700">
                            Niveau / enseignement
                        </label>

                        <select
                            id="enseignement"
                            name="enseignement"
                            class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-slate-900 focus:ring-slate-900">

                            <option value="">Sélectionner</option>

                            <option value="Préscolaire" @selected(old('enseignement') === 'Préscolaire')>
                                Préscolaire
                            </option>

                            <option value="Primaire" @selected(old('enseignement') === 'Primaire')>
                                Primaire
                            </option>

                            <option value="Secondaire général" @selected(old('enseignement') === 'Secondaire général')>
                                Secondaire général
                            </option>

                            <option value="Secondaire technique" @selected(old('enseignement') === 'Secondaire technique')>
                                Secondaire technique
                            </option>

                            <option value="Plusieurs niveaux" @selected(old('enseignement') === 'Plusieurs niveaux')>
                                Plusieurs niveaux
                            </option>

                        </select>

                        @error('enseignement')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

            </div>

            {{-- Localisation --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

                <div class="border-b border-slate-100 bg-slate-50 px-6 py-5">
                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100">
                            📍
                        </div>

                        <div>
                            <h3 class="font-bold text-slate-800">
                                Localisation administrative
                            </h3>

                            <p class="text-sm text-slate-500">
                                Situation géographique de l'établissement
                            </p>
                        </div>

                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Adresse
                        </label>

                        <input
                            type="text"
                            name="adresse"
                            value="{{ old('adresse') }}"
                            placeholder="Adresse complète"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Ville
                        </label>

                        <input
                            type="text"
                            name="ville"
                            value="{{ old('ville') }}"
                            placeholder="Ex. Abidjan"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Commune
                        </label>

                        <input
                            type="text"
                            name="commune"
                            value="{{ old('commune') }}"
                            placeholder="Ex. Cocody"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            District
                        </label>

                        <input
                            type="text"
                            name="district"
                            value="{{ old('district') }}"
                            placeholder="Ex. District autonome d'Abidjan"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Région
                        </label>

                        <input
                            type="text"
                            name="region"
                            value="{{ old('region') }}"
                            placeholder="Région"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            DRENA
                        </label>

                        <input
                            type="text"
                            name="drena"
                            value="{{ old('drena') }}"
                            placeholder="DRENA"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            IEPP
                        </label>

                        <input
                            type="text"
                            name="iepp"
                            value="{{ old('iepp') }}"
                            placeholder="IEPP"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                    </div>

                </div>

            </div>

            {{-- Contact --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

                <div class="border-b border-slate-100 bg-slate-50 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-100">
                            📞
                        </div>

                        <div>
                            <h3 class="font-bold text-slate-800">
                                Coordonnées
                            </h3>

                            <p class="text-sm text-slate-500">
                                Informations permettant de contacter l'établissement
                            </p>
                        </div>

                    </div>

                </div>

                <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Téléphone
                        </label>

                        <input
                            type="text"
                            name="telephone"
                            value="{{ old('telephone') }}"
                            placeholder="+225 XX XX XX XX XX"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-violet-500 focus:ring-violet-500"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Adresse e-mail
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="contact@etablissement.ci"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-violet-500 focus:ring-violet-500"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Date de création
                        </label>

                        <input
                            type="date"
                            name="date_creation"
                            value="{{ old('date_creation') }}"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-violet-500 focus:ring-violet-500"
                        >
                    </div>

                </div>

            </div>

            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('admin.etablissements.index') }}"
                    class="rounded-xl border border-slate-300 bg-white px-6 py-3 text-center text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Annuler
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-indigo-600 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Enregistrer l'établissement
                </button>

            </div>

        </form>

    </div>

</x-app-layout>