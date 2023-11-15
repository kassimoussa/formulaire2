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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer('numero')->nullable();
            $table->string('nom')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('domicile')->nullable();
            $table->string('profession')->nullable();
            $table->string('id_piece')->nullable();
            $table->string('type_piece')->nullable(); 
            $table->string('piece_recto')->nullable();
            $table->string('piece_verso')->nullable();
            $table->string('piece_recto_public_path')->nullable();
            $table->string('piece_recto_storage_path')->nullable();
            $table->string('piece_verso_public_path')->nullable();
            $table->string('piece_verso_storage_path')->nullable();
            $table->date('date_emission')->nullable();
            $table->date('date_expiration')->nullable();
            $table->string('photo')->nullable();
            $table->string('photo_public_path')->nullable();
            $table->string('photo_storage_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
