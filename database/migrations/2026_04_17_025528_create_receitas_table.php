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
      Schema::create('receitas', function (Blueprint $table) {
    $table->id();
    $table->string('titulo');
    $table->text('ingredientes');
    $table->text('modo_preparo');
    $table->string('imagem')->nullable();
    $table->boolean('favorito')->default(false);

    // Categoria da receita (1 categoria pode ter várias receitas)
    $table->foreignId('categoria_id')->nullable()->constrained('categorias')->onDelete('set null');

    // Se o usuário for deletado, as receitas associadas a ele também serão deletadas
    $table->foreignId('users_id')->constrained('users')->onDelete('cascade');

    $table->timestamps();
});
    }
        

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receitas');
    }
};
