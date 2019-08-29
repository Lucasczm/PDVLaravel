<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('transacao')->unsigned();
            $table->string('codigo_estoque');
            $table->integer('codigo_estoque_aux')->unsigned();
            $table->integer('quantidade');
            $table->decimal('valor_venda',10,2);
            
            $table->foreign('transacao')->references('id')->on('transacoes');
            $table->foreign('codigo_estoque')->references('codigo')->on('estoques');
            $table->foreign('codigo_estoque_aux')->references('id')->on('estoque_auxes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
