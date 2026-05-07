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
        Schema::create('publicacion_tecnologia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publicacion_id')->constrained('publicaciones')->cascadeOnDelete();
            $table->foreignId('tecnologia_id')->constrained('tecnologias')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['publicacion_id', 'tecnologia_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicacion_tecnologia');
    }
};
