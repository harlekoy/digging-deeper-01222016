<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    public function run() {}

    /**
     * Add the updated_at and created_at timestamp in the inserted data
     * 
     * @param array $arr
     * @author Harlequin Doyon
     */
    public function addTimestamps($arr)
    {
        $now = Carbon::now();
        $timestamps = ['updated_at' => $now, 'created_at' => $now];

        return array_merge($arr, $timestamps);
    }
}
