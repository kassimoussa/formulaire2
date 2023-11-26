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
        Schema::create('liste_sims', function (Blueprint $table) {
            $table->id();
            $table->string('part_id')->nullable();
            $table->bigInteger('numero');
            $table->string('nom')->nullable();
            $table->string('status')->nullable();
            $table->string('groupe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liste_sims');
    }
};
