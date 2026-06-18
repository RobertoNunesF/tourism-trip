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
        // updateOrCreate: se o e-mail já existir, reseta pra senha original;
        // se não existir, cria. Pode rodar esse seeder quantas vezes quiser.
        User::updateOrCreate(
            ['email' => 'adm@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'must_change_password' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'gestor@example.com'],
            [
                'name' => 'Gestor',
                'password' => Hash::make('password'),
                'must_change_password' => true,
            ]
        );
    }
}