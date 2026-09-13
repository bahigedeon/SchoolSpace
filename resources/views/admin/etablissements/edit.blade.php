<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier l'établissement
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

                <form action="{{ route('admin.etablissements.update', $etablissement) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            Informations principales
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Code officiel *
                                </label>

                                <input type="text"
                                       name="code_etablissement"
                                       value="{{ old('code_etablissement', $etablissement->code_etablissement) }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Nom de l'établissement *
                                </label>

                                <input type="text"
                                       name="nom"
                                       value="{{ old('nom', $etablissement->nom) }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Type
                                </label>

                                <input type="text"
                                       name="type"
                                       value="{{ old('type', $etablissement->type) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Statut
                                </label>

                                <input type="text"
                                       name="statut"
                                       value="{{ old('statut', $etablissement->statut) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Enseignement
                                </label>

                                <input type="text"
                                       name="enseignement"
                                       value="{{ old('enseignement', $etablissement->enseignement) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Date de création
                                </label>

                                <input type="date"
                                       name="date_creation"
                                       value="{{ old('date_creation', $etablissement->date_creation?->format('Y-m-d')) }}"
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
                                       value="{{ old('adresse', $etablissement->adresse) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Ville
                                </label>

                                <input type="text"
                                       name="ville"
                                       value="{{ old('ville', $etablissement->ville) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Commune
                                </label>

                                <input type="text"
                                       name="commune"
                                       value="{{ old('commune', $etablissement->commune) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    District
                                </label>

                                <input type="text"
                                       name="district"
                                       value="{{ old('district', $etablissement->district) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Région
                                </label>

                                <input type="text"
                                       name="region"
                                       value="{{ old('region', $etablissement->region) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    DRENA
                                </label>

                                <input type="text"
                                       name="drena"
                                       value="{{ old('drena', $etablissement->drena) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    IEPP
                                </label>

                                <input type="text"
                                       name="iepp"
                                       value="{{ old('iepp', $etablissement->iepp) }}"
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
                                       value="{{ old('telephone', $etablissement->telephone) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Email
                                </label>

                                <input type="email"
                                       name="email"
                                       value="{{ old('email', $etablissement->email) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3">

                        <a href="{{ route('admin.etablissements.show', $etablissement) }}"
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                            Annuler
                        </a>

                        <button type="submit"
                                class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Enregistrer les modifications
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>