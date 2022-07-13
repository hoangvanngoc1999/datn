<?php

namespace Database\Seeders;

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
        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
            0 => array(
                'id' => 1,
                'email' => 'admin@gmail.com',
                'name' => 'Administrators',
                'password' => bcrypt('123456'),
            ),
            1 => array(
                'id' => 2,
                'email' => 'demoadmin@gmail.com',
                'name' => 'Demo',
                'password' => bcrypt('123456'),
            ),
        ));
    }
}