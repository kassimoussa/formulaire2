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
        Schema::create('secret_codes', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->string('code');
            $table->string('status')->default('no'); 
            $table->timestamp('date_envoie');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secret_codes');
    }
};
