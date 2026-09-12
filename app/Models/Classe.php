<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classe extends Model
{
    protected $fillable = [
        'etablissement_id',
        'annee_scolaire_id',
        'niveau',
        'serie',
        'nom',
        'effectif',
        'salle_principale_id',
        'statut',
    ];

    public function etablissement(): BelongsTo
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function anneeScolaire(): BelongsTo
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function sallePrincipale(): BelongsTo
    {
        return $this->belongsTo(Salle::class, 'salle_principale_id');
    }

    public function eleves(): HasMany
    {
        return $this->hasMany(Eleve::class);
    }

    public function cours(): HasMany
    {
        return $this->hasMany(Cours::class);
    }
}