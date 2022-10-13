<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TableUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'nm_lengkap'=> 'Administrator',
            'username'  => 'admin',
            'password'  => \Hash::make('admin'),
        ]);
    }
}
