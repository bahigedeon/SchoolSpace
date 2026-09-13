<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Etablissement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EtablissementController extends Controller
{
    /**
     * Afficher la liste des établissements.
     */
    public function index(Request $request)
{
    $query = Etablissement::query();

    if ($request->filled('search')) {
        $search = $request->string('search')->toString();

        $query->where(function ($q) use ($search) {
            $q->where('code_etablissement', 'like', "%{$search}%")
                ->orWhere('nom', 'like', "%{$search}%")
                ->orWhere('ville', 'like', "%{$search}%")
                ->orWhere('commune', 'like', "%{$search}%");
        });
    }

    $etablissements = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('admin.etablissements.index', compact('etablissements'));
}

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        return view('admin.etablissements.create');
    }

    /**
     * Enregistrer un établissement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_etablissement' => [
                'required',
                'string',
                'max:50',
                'unique:etablissements,code_etablissement',
            ],
            'nom' => ['required', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:100'],
            'statut' => ['nullable', 'string', 'max:100'],
            'enseignement' => ['nullable', 'string', 'max:100'],
            'adresse' => ['nullable', 'string', 'max:255'],
            'ville' => ['nullable', 'string', 'max:100'],
            'commune' => ['nullable', 'string', 'max:100'],
            'district' => ['nullable', 'string', 'max:100'],
            'region' => ['nullable', 'string', 'max:100'],
            'drena' => ['nullable', 'string', 'max:100'],
            'iepp' => ['nullable', 'string', 'max:100'],
            'telephone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'date_creation' => ['nullable', 'date'],
        ]);

        Etablissement::create($validated);

        return redirect()
            ->route('admin.etablissements.index')
            ->with('success', 'Établissement créé avec succès.');
    }

    /**
     * Afficher un établissement.
     */
    public function show(Etablissement $etablissement)
    {
        return view('admin.etablissements.show', compact('etablissement'));
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(Etablissement $etablissement)
    {
        return view('admin.etablissements.edit', compact('etablissement'));
    }

    /**
     * Modifier un établissement.
     */
    public function update(Request $request, Etablissement $etablissement)
    {
        $validated = $request->validate([
            'code_etablissement' => [
                'required',
                'string',
                'max:50',
                Rule::unique('etablissements', 'code_etablissement')
                    ->ignore($etablissement->id),
            ],
            'nom' => ['required', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:100'],
            'statut' => ['nullable', 'string', 'max:100'],
            'enseignement' => ['nullable', 'string', 'max:100'],
            'adresse' => ['nullable', 'string', 'max:255'],
            'ville' => ['nullable', 'string', 'max:100'],
            'commune' => ['nullable', 'string', 'max:100'],
            'district' => ['nullable', 'string', 'max:100'],
            'region' => ['nullable', 'string', 'max:100'],
            'drena' => ['nullable', 'string', 'max:100'],
            'iepp' => ['nullable', 'string', 'max:100'],
            'telephone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'date_creation' => ['nullable', 'date'],
        ]);

        $etablissement->update($validated);

        return redirect()
            ->route('admin.etablissements.index')
            ->with('success', 'Établissement modifié avec succès.');
    }

    /**
     * Supprimer un établissement.
     */
    public function destroy(Etablissement $etablissement)
    {
        $etablissement->delete();

        return redirect()
            ->route('admin.etablissements.index')
            ->with('success', 'Établissement supprimé avec succès.');
    }
}