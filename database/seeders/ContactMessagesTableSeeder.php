<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactMessagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contact_messages')->delete();
        
        \DB::table('contact_messages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'hhhhhh',
                'email' => 'hhhgg@gmail.com',
                'phone' => '123',
                'message' => '',
                'status' => 'okundu',
                'admin_reply' => NULL,
                'created_at' => '2026-05-21 20:43:58',
                'updated_at' => '2026-05-21 20:44:48',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'hhhhhh',
                'email' => 'hhhgg@gmail.com',
                'phone' => '123',
                'message' => '',
                'status' => 'okundu',
                'admin_reply' => NULL,
                'created_at' => '2026-05-21 20:44:00',
                'updated_at' => '2026-05-21 20:44:47',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'demir can',
                'email' => 'asd@gmail.com',
                'phone' => '0530 123 17 25',
                'message' => '',
                'status' => 'okundu',
                'admin_reply' => NULL,
                'created_at' => '2026-05-21 20:44:16',
                'updated_at' => '2026-05-21 20:44:45',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Duran Can Demirezen',
                'email' => 'cndemirezen11@gmail.com',
                'phone' => '05309104102',
                'message' => '',
                'status' => 'okundu',
                'admin_reply' => 'sdfasdfasdfdfs',
                'created_at' => '2026-05-21 20:54:57',
                'updated_at' => '2026-05-21 21:35:57',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Duran Can Demirezen',
                'email' => 'cndemirezen11@gmail.com',
                'phone' => '05551112233',
                'message' => 'kklllm',
                'status' => 'cevaplandi',
                'admin_reply' => 'llllllllllllllllmmm',
                'created_at' => '2026-05-21 22:36:39',
                'updated_at' => '2026-05-21 22:37:16',
            ),
        ));
        
        
    }
}