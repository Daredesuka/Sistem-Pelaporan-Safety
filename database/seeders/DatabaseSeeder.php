<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Petugas::create([
            'nama_petugas'  => 'Administrator',
            'username'  => 'admin',
            'telp' => '082117564354',
            'password'  => bcrypt('indonesia'),
            'roles' => 'admin'
        ]);
    }
}
