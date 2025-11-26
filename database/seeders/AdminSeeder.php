<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Verificar se já existe
        if (User::where('email', 'admin@iffar.edu.br')->exists()) {
            $this->command->info('Usuário admin já existe!');
            return;
        }

        // Criar usuário admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@iffar.edu.br',
            'password' => Hash::make('admin123'),
            'user_type' => 'admin',
            'cpf' => '00000000000',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Usuário admin criado com sucesso!');
        $this->command->info('Email: admin@iffar.edu.br');
        $this->command->info('Senha: admin123');
    }
}
