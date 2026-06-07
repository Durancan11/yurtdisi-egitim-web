<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AnnouncementsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('announcements')->delete();
        
        \DB::table('announcements')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'test',
                'content' => 'test1',
                'type' => 'emerald',
                'is_active' => 1,
                'created_at' => '2026-05-22 17:05:48',
                'updated_at' => '2026-05-22 17:05:48',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'test2',
                'content' => 'test2',
                'type' => 'amber',
                'is_active' => 1,
                'created_at' => '2026-05-22 17:05:55',
                'updated_at' => '2026-05-22 17:05:55',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'test3',
                'content' => 'test3',
                'type' => 'indigo',
                'is_active' => 1,
                'created_at' => '2026-05-22 17:06:01',
                'updated_at' => '2026-05-22 17:06:01',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'test4',
                'content' => 'test4',
                'type' => 'rose',
                'is_active' => 1,
                'created_at' => '2026-05-22 17:06:10',
                'updated_at' => '2026-05-22 17:06:10',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'testttt',
                'content' => 'testt',
                'type' => 'amber',
                'is_active' => 1,
                'created_at' => '2026-05-27 18:59:23',
                'updated_at' => '2026-05-27 18:59:23',
            ),
        ));
        
        
    }
}