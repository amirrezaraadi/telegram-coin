<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('player_energy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('energy_id')
                ->constrained('energies')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('energyLast')->default(0)->nullable();
            $table->string('energy_time')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_energy');
    }
};
