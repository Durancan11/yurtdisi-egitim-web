<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BalanceRequestsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('balance_requests')->delete();
        
        \DB::table('balance_requests')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'amount' => '1000.00',
                'status' => 'approved',
                'created_at' => '2026-05-16 20:57:53',
                'updated_at' => '2026-05-16 21:28:02',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'amount' => '10000.00',
                'status' => 'approved',
                'created_at' => '2026-05-22 14:15:32',
                'updated_at' => '2026-05-22 16:12:14',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 2,
                'amount' => '1500.00',
                'status' => 'approved',
                'created_at' => '2026-05-22 14:29:08',
                'updated_at' => '2026-05-22 16:12:12',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 7,
                'amount' => '500000.00',
                'status' => 'approved',
                'created_at' => '2026-05-22 19:33:27',
                'updated_at' => '2026-05-22 19:33:58',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 2,
                'amount' => '100000.00',
                'status' => 'approved',
                'created_at' => '2026-05-27 16:49:50',
                'updated_at' => '2026-05-31 18:14:51',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 8,
                'amount' => '152.00',
                'status' => 'approved',
                'created_at' => '2026-05-27 18:57:34',
                'updated_at' => '2026-05-27 18:59:14',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 2,
                'amount' => '100000.00',
                'status' => 'pending',
                'created_at' => '2026-05-31 19:37:29',
                'updated_at' => '2026-05-31 19:37:29',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 2,
                'amount' => '5555.00',
                'status' => 'pending',
                'created_at' => '2026-05-31 19:37:45',
                'updated_at' => '2026-05-31 19:37:45',
            ),
        ));
        
        
    }
}