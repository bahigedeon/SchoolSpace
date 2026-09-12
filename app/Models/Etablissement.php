<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Etablissement extends Model
{
    protected $fillable = [
        'code_etablissement',
        'nom',
        'type',
        'statut',
        'enseignement',
        'adresse',
        'ville',
        'commune',
        'district',
        'region',
        'drena',
        'iepp',
        'telephone',
        'email',
        'logo',
        'date_creation',
    ];

    protected $casts = [
        'date_creation' => 'date',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function anneesScolaires(): HasMany
    {
        return $this->hasMany(AnneeScolaire::class);
    }

    public function salles(): HasMany
    {
        return $this->hasMany(Salle::class);
    }

    public function classes(): HasMany
    {
        return $this->hasMany(Classe::class);
    }

    public function eleves(): HasMany
    {
        return $this->hasMany(Eleve::class);
    }

    public function professeurs(): HasMany
    {
        return $this->hasMany(Professeur::class);
    }

    public function educateurs(): HasMany
    {
        return $this->hasMany(Educateur::class);
    }

    public function matieres(): HasMany
    {
        return $this->hasMany(Matiere::class);
    }

    public function cours(): HasMany
    {
        return $this->hasMany(Cours::class);
    }
}