<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin Duran Can',
                'email' => 'admin@globalvizyon.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$c5BwQeHyl/5tIzhNiADWbO62JJrSPlv7y1nY2uOp41aVq6VIgz60G',
                'role' => 'admin',
                'balance' => '0.00',
                'status' => 'active',
                'remember_token' => NULL,
                'created_at' => '2026-05-16 20:48:03',
                'updated_at' => '2026-05-16 20:48:03',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Öğrenci Kullanıcı 1',
                'email' => 'user1@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$/WqqRKTx8YGIZplU22wP6e1ZtYOPOH7ewsNyzYIQQN3nLKGkFRzV.',
                'role' => 'user',
                'balance' => '112472.00',
                'status' => 'active',
                'remember_token' => NULL,
                'created_at' => '2026-05-16 20:48:03',
                'updated_at' => '2026-05-31 18:14:51',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Öğrenci Kullanıcı 2',
                'email' => 'user2@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$KLvY9n43Ehw/PxV4TB8fPusxxPzLTGO73D9LI1e/pJMTFKwTTNRta',
                'role' => 'user',
                'balance' => '500.00',
                'status' => 'active',
                'remember_token' => NULL,
                'created_at' => '2026-05-16 20:48:03',
                'updated_at' => '2026-05-16 20:48:03',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Öğrenci Kullanıcı 3',
                'email' => 'user3@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$qywzXmE/lst9GjYXeUce..BcGyOCeuH8uzdwZXi.4vSEB6hJo1nou',
                'role' => 'user',
                'balance' => '500.00',
                'status' => 'active',
                'remember_token' => NULL,
                'created_at' => '2026-05-16 20:48:04',
                'updated_at' => '2026-05-16 20:48:04',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Öğrenci Kullanıcı 4',
                'email' => 'user4@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$DaSWcAk2xqu9SOWaTViSwexjm1A9gGaWk/SZgySbvMZWKz/cATRaG',
                'role' => 'user',
                'balance' => '500.00',
                'status' => 'active',
                'remember_token' => NULL,
                'created_at' => '2026-05-16 20:48:04',
                'updated_at' => '2026-05-16 20:48:04',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Öğrenci Kullanıcı 5',
                'email' => 'user5@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$SxYPIk5msmXJBe8AukwMFOC6xhl1ubZc6b3OJfyFlJsBZQkx23lhW',
                'role' => 'user',
                'balance' => '500.00',
                'status' => 'active',
                'remember_token' => NULL,
                'created_at' => '2026-05-16 20:48:04',
                'updated_at' => '2026-05-16 20:48:04',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'test',
                'email' => 'test123@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$6c6tVYvMgFxsmUCj6J8kYuXZ8z9fOFuc5WSkJFTzUY/PzyymZukuy',
                'role' => 'user',
                'balance' => '490910.00',
                'status' => 'active',
                'remember_token' => NULL,
                'created_at' => '2026-05-22 19:32:24',
                'updated_at' => '2026-05-31 17:53:43',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'testtt11',
                'email' => 'asd11@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$a7/fAJ.MabfhCpk5.Vz3.OXHPjstGb6YB0gWLqhoIaeHFU326ypk6',
                'role' => 'user',
                'balance' => '152.00',
                'status' => 'active',
                'remember_token' => NULL,
                'created_at' => '2026-05-27 18:55:30',
                'updated_at' => '2026-05-27 18:59:14',
            ),
        ));
        
        
    }
}