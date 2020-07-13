<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'  =>  'Автор второй',
                'email' =>  'autor@gmail.com',
                'password'  =>  bcrypt('123456'),
            ],
            [
                'name'  =>  'Автор первый',
                'email' =>  'autor1@gmail.com',
                'password'  =>  bcrypt('999999'),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
