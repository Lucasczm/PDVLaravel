<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstoquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoques', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('codigo');
            $table->string('categoria');
            $table->string('nome');
            $table->string('marca');
            $table->string('descricao');
            $table->string('tecido')->nullable();
            $table->integer('estoque');
            $table->string('unidade');
            $table->string('fornecedor');
            $table->decimal('lucro',10,2);
            $table->decimal('preco_custo',10,2);
            $table->decimal('preco',10,2);
            
            $table->index(['codigo']);
            
            $table->foreign('categoria')->references('categoria')->on('categorias')->onUpdate('cascade');
            $table->foreign('tecido')->references('tecido')->on('tecidos')->onUpdate('cascade');
            $table->foreign('marca')->references('marca')->on('marcas')->onUpdate('cascade');
            $table->foreign('fornecedor')->references('fornecedor')->on('fornecedors')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estoques');
    }
}
