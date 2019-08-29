<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacoes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('cliente');
            $table->date('data');
            $table->integer('desconto');
            $table->enum('pagamento',['DI','CR','DE']);
            $table->integer('parcelas');
            $table->decimal('valor_parcelas',10,2);
            $table->decimal('total',10,2);
            $table->timestamps();
            
            $table->foreign('cliente')->references('CPF')->on('clientes')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacoes');
    }
}
