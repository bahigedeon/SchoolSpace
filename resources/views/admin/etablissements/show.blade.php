<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Détails de l'établissement
            </h2>

            <a href="{{ route('admin.etablissements.edit', $etablissement) }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Modifier
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">

                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center gap-4">

                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-indigo-600">
                                {{ strtoupper(substr($etablissement->nom, 0, 1)) }}
                            </span>
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">
                                {{ $etablissement->nom }}
                            </h1>

                            <p class="text-indigo-600 font-semibold">
                                {{ $etablissement->code_etablissement }}
                            </p>
                        </div>

                    </div>
                </div>

                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Informations générales
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <p class="text-sm text-gray-500">Type</p>
                            <p class="font-medium text-gray-900">
                                {{ $etablissement->type ?? 'Non renseigné' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Statut</p>
                            <p class="font-medium text-gray-900">
                                {{ $etablissement->statut ?? 'Non renseigné' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Enseignement</p>
                            <p class="font-medium text-gray-900">
                                {{ $etablissement->enseignement ?? 'Non renseigné' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Date de création</p>
                            <p class="font-medium text-gray-900">
                                {{ $etablissement->date_creation?->format('d/m/Y') ?? 'Non renseignée' }}
                            </p>
                        </div>

                    </div>

                    <hr class="my-8">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Localisation
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <p class="text-sm text-gray-500">Adresse</p>
                            <p class="font-medium text-gray-900">
                                {{ $etablissement->adresse ?? 'Non renseignée' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Ville</p>
                            <p class="font-medium text-gray-900">
                                {{ $etablissement->ville ?? 'Non renseignée' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Commune</p>
                            <p class="font-medium text-gray-900">
                                {{ $etablissement->commune ?? 'Non renseignée' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">District</p>
                            <p class="font-medium text-gray-900">
                                {{ $etablissement->district ?? 'Non renseigné' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Région</p>
                            <p class="font-medium text-gray-900">
                                {{ $etablissement->region ?? 'Non renseignée' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">DRENA</p>
                            <p class="font-medium text-gray-900">
                                {{ $etablissement->drena ?? 'Non renseignée' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">IEPP</p>
                            <p class="font-medium text-gray-900">
                                {{ $etablissement->iepp ?? 'Non renseigné' }}
                            </p>
                        </div>

                    </div>

                    <hr class="my-8">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Contact
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <p class="text-sm text-gray-500">Téléphone</p>
                            <p class="font-medium text-gray-900">
                                {{ $etablissement->telephone ?? 'Non renseigné' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium text-gray-900">
                                {{ $etablissement->email ?? 'Non renseigné' }}
                            </p>
                        </div>

                    </div>

                    <div class="mt-8">
                        <a href="{{ route('admin.etablissements.index') }}"
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                            ← Retour à la liste
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>