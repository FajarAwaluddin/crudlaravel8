<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {   //menambah data secara manual ke database 
        DB::table('employees')->insert([
            'nama' => 'Fajar Awaluddin',
            'jeniskelamin' => 'cowo',
            'notelp' => '012345',
        ]);
    }
}
