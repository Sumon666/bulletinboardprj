<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'id' => '2',
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('87654321'),
            'profile' => 'user',
            'type' => '1',
            'phone' => '092345678',
            'dob' => '1994-07-18',
            'create_user_id' => '2',
            'updated_user_id' => '2',
            'created_at' => '2019-11-01',
            'updated_at' => '2019-11-01',
        ]);
    }
}
