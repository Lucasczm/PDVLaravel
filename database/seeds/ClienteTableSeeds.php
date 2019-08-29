<?php

use Illuminate\Database\Seeder;
use App\Models\Cliente;
class ClienteTableSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'nome' => 'NÃO IDENTIFICADO',
            'CPF' => '000.000.000-00',
            'sexo' => 'I',
            'telefone' => '(00)000000000',
        ]);
       
      
    }
}
