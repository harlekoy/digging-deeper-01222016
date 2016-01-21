<?php

class TaskTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->delete();

        foreach ($this->data() as $task) {
            DB::table('tasks')->insert($this->addTimestamps($task));
        }
    }

    public function data()
    {
        return [
            ['id' => 1, 'name' => 'Task 1', 'slug' => 'task-1', 'project_id' => 1, 'completed' => false, 'description' => 'My first task'],
            ['id' => 2, 'name' => 'Task 2', 'slug' => 'task-2', 'project_id' => 1, 'completed' => false, 'description' => 'My first task'],
            ['id' => 3, 'name' => 'Task 3', 'slug' => 'task-3', 'project_id' => 1, 'completed' => false, 'description' => 'My first task'],
            ['id' => 4, 'name' => 'Task 4', 'slug' => 'task-4', 'project_id' => 1, 'completed' => true, 'description' => 'My second task'],
            ['id' => 5, 'name' => 'Task 5', 'slug' => 'task-5', 'project_id' => 1, 'completed' => true, 'description' => 'My third task'],
            ['id' => 6, 'name' => 'Task 6', 'slug' => 'task-6', 'project_id' => 2, 'completed' => true, 'description' => 'My fourth task'],
            ['id' => 7, 'name' => 'Task 7', 'slug' => 'task-7', 'project_id' => 2, 'completed' => false, 'description' => 'My fifth task'],
        ];
    }
}
