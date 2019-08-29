<?php


use Illuminate\Database\Seeder;
use App\Models\Sistema;

class SistemaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sistema::create([
            'config' => 'caixa_aberto',
            'value'  => false
        ]);
    }
}
