<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un établissement
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
                        <p class="font-semibold mb-2">
                            Veuillez corriger les erreurs suivantes :
                        </p>

                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.etablissements.store') }}" method="POST">
                    @csrf

                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            Informations principales
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Code officiel de l'établissement *
                                </label>

                                <input type="text"
                                       name="code_etablissement"
                                       value="{{ old('code_etablissement') }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                                <p class="mt-1 text-xs text-gray-500">
                                    Code officiel attribué à l'établissement.
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Nom de l'établissement *
                                </label>

                                <input type="text"
                                       name="nom"
                                       value="{{ old('nom') }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Type
                                </label>

                                <input type="text"
                                       name="type"
                                       value="{{ old('type') }}"
                                       placeholder="Lycée, collège, université..."
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Statut
                                </label>

                                <input type="text"
                                       name="statut"
                                       value="{{ old('statut') }}"
                                       placeholder="Public, privé..."
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Enseignement
                                </label>

                                <input type="text"
                                       name="enseignement"
                                       value="{{ old('enseignement') }}"
                                       placeholder="Général, technique..."
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Date de création
                                </label>

                                <input type="date"
                                       name="date_creation"
                                       value="{{ old('date_creation') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            Localisation
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Adresse
                                </label>

                                <input type="text"
                                       name="adresse"
                                       value="{{ old('adresse') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Ville
                                </label>

                                <input type="text"
                                       name="ville"
                                       value="{{ old('ville') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Commune
                                </label>

                                <input type="text"
                                       name="commune"
                                       value="{{ old('commune') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    District
                                </label>

                                <input type="text"
                                       name="district"
                                       value="{{ old('district') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Région
                                </label>

                                <input type="text"
                                       name="region"
                                       value="{{ old('region') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    DRENA
                                </label>

                                <input type="text"
                                       name="drena"
                                       value="{{ old('drena') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    IEPP
                                </label>

                                <input type="text"
                                       name="iepp"
                                       value="{{ old('iepp') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            Contact
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Téléphone
                                </label>

                                <input type="text"
                                       name="telephone"
                                       value="{{ old('telephone') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Email
                                </label>

                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3">

                        <a href="{{ route('admin.etablissements.index') }}"
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                            Annuler
                        </a>

                        <button type="submit"
                                class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Enregistrer
                        </button>

                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>