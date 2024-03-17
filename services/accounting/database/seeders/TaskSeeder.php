<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $task = new Task();
        $task->executor_id = 3;
        $task->name = 'Test task';
        $task->description = 'Test task description';
        $task->status = Status::Uncompleted->name;
        $task->save();
    }
}
