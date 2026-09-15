<?php

use App\Models\Role;
use App\Models\User;

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('allows storing an establishment with valid enum values', function () {
    $role = Role::firstOrCreate(
        ['nom' => 'admin'],
        ['description' => 'Administrateur']
    );

    $admin = User::factory()->create([
        'role_id' => $role->id,
        'email' => 'admin@example.com',
        'name' => 'Admin',
        'nom' => 'Admin',
        'prenom' => 'School',
        'statut' => 'actif',
    ]);

    $response = $this->actingAs($admin)
        ->post(route('admin.etablissements.store'), [
            'code_etablissement' => 'ECO123',
            'nom' => 'École de test',
            'type' => 'public',
            'statut' => 'actif',
            'enseignement' => 'Primaire',
            'adresse' => 'Abidjan',
            'ville' => 'Abidjan',
            'commune' => 'Cocody',
            'district' => 'Abidjan',
            'region' => 'Abidjan',
            'telephone' => '+22501020304',
            'email' => 'ecole@example.com',
            'date_creation' => '2024-01-15',
        ]);

    $response->assertRedirect(route('admin.etablissements.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('etablissements', [
        'code_etablissement' => 'ECO123',
        'nom' => 'École de test',
        'type' => 'public',
        'statut' => 'actif',
    ]);
});
