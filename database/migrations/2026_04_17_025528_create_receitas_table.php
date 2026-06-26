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
            $table->enum('categorias', ['almoco', 'janta', 'lanche', 'sobremesa']);

/* Comentei pq ao conversar com o Paim ele me disse para deixar as categorias cadastradas ja 

            $table->unsignedBigInteger('categoria_id'); //ele esta criando na tabela receitas uma coluna categoria_id 
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade'); //aqui ele esta criando uma chave estrangeira que referencia a coluna 
*/            //id da tabela categorias, e se a categoria for deletada, as receitas associadas a ela também serão deletadas (cascade)
  

$table->unsignedBigInteger('users_id'); 
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        
          
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
