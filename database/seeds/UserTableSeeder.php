<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Faker\Factory::create();

        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'username' => 'admin_admin',
            'email' => 'admin@ews.com',
            'password' => bcrypt('admin'),
            'phone' => '65656555',
            'address' => 'Dhaka',
            'city' => 'Dhaka',
            'country' => 'bangladesh',
            'type' => 'admin',
            'gender' => 1,
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Shojib',
            'last_name' => 'islam',
            'username' => 'shojib_editor',
            'email' => 'shojib@ews.com',
            'password' => bcrypt('shojib'),
            'phone' => '01553717992',
            'address' => 'Dhaka',
            'city' => 'Dhaka',
            'country' => 'bangladesh',
            'type' => 'editor',
            'gender' => 1,
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'shanto',
            'last_name' => 'islam',
            'username' => 'shanto_editor',
            'email' => 'shanto@ews.com',
            'password' => bcrypt('shanto'),
            'phone' => '01553717992',
            'address' => 'Dhaka',
            'city' => 'Dhaka',
            'country' => 'bangladesh',
            'type' => 'author',
            'gender' => 1,
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);
    }
}
