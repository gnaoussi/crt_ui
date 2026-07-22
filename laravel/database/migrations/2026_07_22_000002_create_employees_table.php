<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('dob')->nullable();
            $table->string('email')->unique();
            $table->string('role')->default('ADMINISTRATEUR');
            $table->string('gestionnaire')->nullable();
            $table->string('probation_status')->default('1 heure restante');
            $table->string('account_status')->default('Activé');
            $table->string('visibility_report')->default('Oui');
            $table->boolean('is_manager')->default(false);
            $table->float('weekly_hours')->default(37.5);
            $table->date('hire_date')->nullable();
            $table->string('site')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
