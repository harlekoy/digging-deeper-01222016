<?php

class ProjectTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->delete();

        foreach ($this->data() as $project) {
            DB::table('projects')->insert($this->addTimestamps($project));
        }
    }

    public function data()
    {
        return [
            ['id' => 1, 'name' => 'Project 1', 'slug' => 'project-1'],
            ['id' => 2, 'name' => 'Project 2', 'slug' => 'project-2'],
            ['id' => 3, 'name' => 'Project 3', 'slug' => 'project-3'],
        ];
    }
}
