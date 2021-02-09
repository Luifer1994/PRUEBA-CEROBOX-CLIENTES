<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //CREAMOS UN ADMINISTRADOR POR DEFECTO
        \App\Models\User::factory(1)->create();

        //CREAMOS LOS TIPO DE SERVICIO POR DEFECTO YA QUE SON SOLO ESTOS DOS
        DB::table('tipo_servicios')->insert([
            'nombre' => 'Basico',
        ]);
        DB::table('tipo_servicios')->insert([
            'nombre' => 'Avanzado',
        ]);
    }
}
