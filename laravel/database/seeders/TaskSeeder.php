<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 未達成
        \App\Models\Task::factory(5)->create();
        
        // 達成済み
        \App\Models\Task::factory(5)->create(['completed' => true]);
    }
}
