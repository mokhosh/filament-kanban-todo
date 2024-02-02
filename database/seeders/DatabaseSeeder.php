<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
         User::factory()->create([
             'name' => 'Mo',
             'email' => 'test@example.com',
         ]);

         $users = User::factory(10)->create();

         Task::factory(30)
             ->recycle($users)
             ->create();
    }
}
