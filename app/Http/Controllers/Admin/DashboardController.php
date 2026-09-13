<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\Etablissement;
use App\Models\Eleve;
use App\Models\Professeur;
use App\Models\Salle;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques générales
        $statistiques = [
            'etablissements' => Etablissement::count(),
            'utilisateurs' => User::count(),
            'professeurs' => Professeur::count(),
            'eleves' => Eleve::count(),
            'salles' => Salle::count(),
            'classes' => Classe::count(),
            'cours' => Cours::count(),
        ];

        // Salles occupées par au moins un cours
        $sallesOccupees = Salle::whereHas('cours')->count();

        // Salles disponibles
        $sallesDisponibles = max(
            $statistiques['salles'] - $sallesOccupees,
            0
        );

        // Taux d'occupation des salles
        $tauxOccupation = $statistiques['salles'] > 0
            ? round(($sallesOccupees / $statistiques['salles']) * 100)
            : 0;

        // Classes dont l'effectif dépasse la capacité de la salle principale
        $classesSurchargees = Classe::with('sallePrincipale')
            ->get()
            ->filter(function ($classe) {
                return $classe->sallePrincipale
                    && $classe->effectif > $classe->sallePrincipale->capacite;
            });

        // Derniers établissements ajoutés
        $etablissementsRecents = Etablissement::latest()
            ->take(5)
            ->get();

        // Derniers utilisateurs inscrits
        $utilisateursRecents = User::with('role')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'statistiques',
            'sallesOccupees',
            'sallesDisponibles',
            'tauxOccupation',
            'classesSurchargees',
            'etablissementsRecents',
            'utilisateursRecents'
        ));
    }
}