<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Crée le compte administrateur général.
     */
    public function run(): void
    {
        $roleAdmin = Role::where('nom', 'admin')->firstOrFail();

        User::updateOrCreate(
            [
                'email' => 'admin@schoolspace.ci',
            ],
            [
                'name' => 'Administrateur SchoolSpace',
                'nom' => 'SchoolSpace',
                'prenom' => 'Administrateur',
                'telephone' => null,
                'statut' => 'actif',
                'role_id' => $roleAdmin->id,
                'etablissement_id' => null,
                'password' => Hash::make('Admin@123456'),
            ]
        );
    }
}