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

         $tasks = Task::factory(30)
             ->recycle($users)
             ->create();

         $tasks->each(function (Task $task) use ($users) {
             $task->team()->attach(
                 $users->shuffle()
                     ->take(fake()->numberBetween(1, 4))
                     ->pluck('id')
             );
         });
    }
}
