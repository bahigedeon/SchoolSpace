<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ROLES
        |--------------------------------------------------------------------------
        */

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 50)->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | ETABLISSEMENTS
        |--------------------------------------------------------------------------
        */

        Schema::create('etablissements', function (Blueprint $table) {
            $table->id();

            // Code officiel de l'établissement
            $table->string('code_etablissement', 30)->unique();

            $table->string('nom', 150);

            $table->enum('type', [
                'public',
                'prive',
                'confessionnel',
                'autre'
            ])->default('prive');

            $table->enum('statut', [
                'actif',
                'inactif'
            ])->default('actif');

            $table->string('enseignement', 100)->nullable();

            $table->string('adresse')->nullable();
            $table->string('ville', 100)->nullable();
            $table->string('commune', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('region', 100)->nullable();

            $table->string('drena', 150)->nullable();
            $table->string('iepp', 150)->nullable();

            $table->string('telephone', 30)->nullable();
            $table->string('email', 150)->nullable();

            $table->string('logo')->nullable();

            $table->date('date_creation')->nullable();

            $table->timestamps();

            $table->index('nom');
            $table->index('ville');
            $table->index('commune');
            $table->index('statut');
        });

        /*
        |--------------------------------------------------------------------------
        | ANNEES SCOLAIRES
        |--------------------------------------------------------------------------
        */

        Schema::create('annees_scolaires', function (Blueprint $table) {
            $table->id();

            $table->foreignId('etablissement_id')
                ->constrained('etablissements')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('libelle', 20);

            $table->date('date_debut');
            $table->date('date_fin');

            $table->enum('statut', [
                'active',
                'terminee',
                'future'
            ])->default('future');

            $table->timestamps();

            $table->unique([
                'etablissement_id',
                'libelle'
            ]);

            $table->index('statut');
        });

        /*
        |--------------------------------------------------------------------------
        | MODIFICATION DE USERS
        |--------------------------------------------------------------------------
        */

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')
                ->nullable()
                ->after('id')
                ->constrained('roles')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('etablissement_id')
                ->nullable()
                ->after('role_id')
                ->constrained('etablissements')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->string('nom', 100)->nullable()->after('name');
            $table->string('prenom', 100)->nullable()->after('nom');

            $table->string('telephone', 30)->nullable()->after('email');

            $table->string('photo')->nullable()->after('password');

            $table->enum('statut', [
                'actif',
                'inactif',
                'bloque'
            ])->default('actif')->after('photo');

            $table->timestamp('last_login_at')->nullable()->after('statut');

            $table->index('role_id');
            $table->index('etablissement_id');
        });

        /*
        |--------------------------------------------------------------------------
        | SALLES
        |--------------------------------------------------------------------------
        */

        Schema::create('salles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('etablissement_id')
                ->constrained('etablissements')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('nom', 100);

            $table->string('code', 50)->nullable();

            $table->unsignedInteger('capacite');

            $table->enum('type', [
                'classe',
                'laboratoire',
                'informatique',
                'bibliotheque',
                'reunion',
                'autre'
            ])->default('classe');

            $table->string('batiment', 100)->nullable();
            $table->string('etage', 50)->nullable();

            $table->enum('etat', [
                'disponible',
                'maintenance',
                'indisponible'
            ])->default('disponible');

            $table->text('description')->nullable();

            $table->timestamps();

            $table->unique([
                'etablissement_id',
                'code'
            ]);

            $table->index('etablissement_id');
            $table->index('capacite');
            $table->index('etat');
        });

        /*
        |--------------------------------------------------------------------------
        | CLASSES
        |--------------------------------------------------------------------------
        */

        Schema::create('classes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('etablissement_id')
                ->constrained('etablissements')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('annee_scolaire_id')
                ->constrained('annees_scolaires')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('niveau', 50);

            $table->string('serie', 50)->nullable();

            $table->string('nom', 100);

            // Peut servir de cache.
            // Le nombre réel d'élèves sera calculé depuis eleves.
            $table->unsignedInteger('effectif')->default(0);

            $table->foreignId('salle_principale_id')
                ->nullable()
                ->constrained('salles')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->enum('statut', [
                'active',
                'inactive'
            ])->default('active');

            $table->timestamps();

            $table->unique([
                'etablissement_id',
                'annee_scolaire_id',
                'nom'
            ]);

            $table->index('etablissement_id');
            $table->index('annee_scolaire_id');
        });

        /*
        |--------------------------------------------------------------------------
        | ELEVES
        |--------------------------------------------------------------------------
        */

        Schema::create('eleves', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->unique()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('etablissement_id')
                ->constrained('etablissements')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('classe_id')
                ->constrained('classes')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('matricule', 50);

            $table->string('nom', 100);
            $table->string('prenom', 100);

            $table->enum('sexe', [
                'M',
                'F'
            ])->nullable();

            $table->date('date_naissance')->nullable();

            $table->string('adresse')->nullable();

            $table->enum('statut', [
                'actif',
                'transfere',
                'diplome',
                'abandon'
            ])->default('actif');

            $table->timestamps();

            $table->unique([
                'etablissement_id',
                'matricule'
            ]);

            $table->index('classe_id');
            $table->index('nom');
        });

        /*
        |--------------------------------------------------------------------------
        | PROFESSEURS
        |--------------------------------------------------------------------------
        */

        Schema::create('professeurs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('etablissement_id')
                ->constrained('etablissements')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('matricule', 50);

            $table->string('specialite', 150)->nullable();

            $table->enum('statut', [
                'actif',
                'inactif'
            ])->default('actif');

            $table->timestamps();

            $table->unique([
                'etablissement_id',
                'matricule'
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | EDUCATEURS
        |--------------------------------------------------------------------------
        */

        Schema::create('educateurs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('etablissement_id')
                ->constrained('etablissements')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('matricule', 50);

            $table->string('fonction', 100)->nullable();

            $table->string('zone_affectation', 150)->nullable();

            $table->enum('statut', [
                'actif',
                'inactif'
            ])->default('actif');

            $table->timestamps();

            $table->unique([
                'etablissement_id',
                'matricule'
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | MATIERES
        |--------------------------------------------------------------------------
        */

        Schema::create('matieres', function (Blueprint $table) {
            $table->id();

            $table->foreignId('etablissement_id')
                ->constrained('etablissements')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('nom', 100);

            $table->string('code', 30)->nullable();

            $table->text('description')->nullable();

            $table->timestamps();

            $table->unique([
                'etablissement_id',
                'code'
            ]);

            $table->index('nom');
        });

        /*
        |--------------------------------------------------------------------------
        | COURS / EMPLOI DU TEMPS
        |--------------------------------------------------------------------------
        */

        Schema::create('cours', function (Blueprint $table) {
            $table->id();

            $table->foreignId('etablissement_id')
                ->constrained('etablissements')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('annee_scolaire_id')
                ->constrained('annees_scolaires')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('classe_id')
                ->constrained('classes')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('matiere_id')
                ->constrained('matieres')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('professeur_id')
                ->constrained('professeurs')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('salle_id')
                ->nullable()
                ->constrained('salles')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->enum('jour', [
                'lundi',
                'mardi',
                'mercredi',
                'jeudi',
                'vendredi',
                'samedi'
            ]);

            $table->time('heure_debut');
            $table->time('heure_fin');

            $table->enum('statut', [
                'programme',
                'annule',
                'termine'
            ])->default('programme');

            $table->text('description')->nullable();

            $table->timestamps();

            $table->index('classe_id');
            $table->index('professeur_id');
            $table->index('salle_id');
            $table->index([
                'jour',
                'heure_debut',
                'heure_fin'
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | NOTIFICATIONS
        |--------------------------------------------------------------------------
        */

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('type', 100);

            $table->string('titre', 150);

            $table->text('message');

            $table->boolean('lu')->default(false);

            $table->timestamp('date_lecture')->nullable();

            $table->timestamps();

            $table->index('user_id');
            $table->index('lu');
        });

        /*
        |--------------------------------------------------------------------------
        | ROLES PAR DEFAUT
        |--------------------------------------------------------------------------
        */

        DB::table('roles')->insert([
            [
                'nom' => 'admin',
                'description' => 'Administrateur général de la plateforme',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'directeur',
                'description' => 'Directeur de l’établissement',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'educateur',
                'description' => 'Éducateur de l’établissement',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'professeur',
                'description' => 'Professeur de l’établissement',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'eleve',
                'description' => 'Élève de l’établissement',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('cours');
        Schema::dropIfExists('matieres');
        Schema::dropIfExists('educateurs');
        Schema::dropIfExists('professeurs');
        Schema::dropIfExists('eleves');
        Schema::dropIfExists('classes');
        Schema::dropIfExists('salles');

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['etablissement_id']);

            $table->dropColumn([
                'role_id',
                'etablissement_id',
                'nom',
                'prenom',
                'telephone',
                'photo',
                'statut',
                'last_login_at'
            ]);
        });

        Schema::dropIfExists('annees_scolaires');
        Schema::dropIfExists('etablissements');
        Schema::dropIfExists('roles');
    }
};