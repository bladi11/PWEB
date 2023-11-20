<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemillaPrueba extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('post')-> insert([
            'ID' => '1',
            'Title' => 'Titulo1',
            'Description' => 'Descripcion1',
            'Completed' => 'Completado'

        ]);
    }
}
