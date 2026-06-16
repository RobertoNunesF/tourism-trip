<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Criar um adm
        User::create([
            'name'=> 'Administrador',
            'email' => 'adm@example.com',
            'password' =>Hash::make('password'),
            'must_change_password' => true,
        ]);
    }
}
