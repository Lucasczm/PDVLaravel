<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstoqueAuxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoque_auxes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('codigo_estoque');
            $table->string('cor');
            $table->integer('estoque');
            $table->string('tamanho');;
            $table->index(['codigo_estoque','cor','tamanho']);
            
            $table->foreign('codigo_estoque')->references('codigo')->on('estoques')->onUpdate('cascade');
            $table->foreign('tamanho')->references('tamanho')->on('tamanhos')->onUpdate('cascade');
            $table->foreign('cor')->references('cor')->on('cors')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estoque_auxes');
    }
}
