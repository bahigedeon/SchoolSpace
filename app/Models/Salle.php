<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Salle extends Model
{
    protected $fillable = [
        'etablissement_id',
        'nom',
        'code',
        'capacite',
        'type',
        'batiment',
        'etage',
        'etat',
        'description',
    ];

    public function etablissement(): BelongsTo
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function classePrincipale(): HasMany
    {
        return $this->hasMany(Classe::class, 'salle_principale_id');
    }

    public function cours(): HasMany
    {
        return $this->hasMany(Cours::class);
    }
}