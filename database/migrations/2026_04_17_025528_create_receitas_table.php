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

            $table->unsignedBigInteger('categoria_id');  
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade'); 
*/          
  

$table->unsignedBigInteger('users_id'); 
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
//aqui esta criando uma chave estrangeira que referencia o users_id, da tabela user. Se o user for deletado, as receitas associadas a ele tmb sera deletada        
          
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
