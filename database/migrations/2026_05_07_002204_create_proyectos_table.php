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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->nullOnDelete();
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('descripcion')->nullable();
            $table->enum('tipo', ['sitio_web', 'aplicacion', 'dashboard', 'tienda_online', 'otro']);
            $table->string('imagen')->nullable();
            $table->string('enlace');
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
        Schema::dropIfExists('proyectos');
    }
};
