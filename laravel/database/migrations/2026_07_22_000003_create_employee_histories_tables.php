<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hours_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->float('hours');
            $table->string('start_date');
            $table->string('end_date')->default('---');
            $table->timestamps();
        });

        Schema::create('manager_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('manager');
            $table->string('start_date');
            $table->string('end_date')->default('---');
            $table->timestamps();
        });

        Schema::create('site_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('site_name');
            $table->string('address')->nullable();
            $table->string('start_date');
            $table->string('end_date')->default('---');
            $table->string('status')->default('Actif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_histories');
        Schema::dropIfExists('manager_histories');
        Schema::dropIfExists('hours_histories');
    }
};
