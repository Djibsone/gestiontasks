<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifier si l'admin existe déjà
        $admin = User::where('email', 'admin@admin.fr')->first();

        if (!$admin) {
            // Créer un utilisateur admin
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.fr',
                'password' => Hash::make('password123'),
            ]);
        }

        // Créer des tâches associées à l'admin
        Task::create([
            'title' => 'Ma première tâche',
            'description' => 'Créer une tâche pour tester le projet.',
            'user_id' => $admin->id,
            'status' => 'completed',
        ]);

        Task::create([
            'title' => 'Ma deuxième tâche',
            'description' => 'Créer quelques tâches pour tester le projet.',
            'user_id' => $admin->id,
            'status' => 'completed',
        ]);
    }
}
