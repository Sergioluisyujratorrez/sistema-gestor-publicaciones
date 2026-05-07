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
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->nullOnDelete();
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('descripcion')->nullable();
            $table->enum('tipo', ['imagen', 'pdf', 'otro']);
            $table->string('archivo');
            $table->string('imagen_portada')->nullable();
            $table->boolean('estado')->default(true);
            $table->unsignedBigInteger('vistas')->default(0);
            $table->timestamp('publicado_en')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicaciones');
    }
};
