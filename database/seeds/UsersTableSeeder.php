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
        DB::table('users')->insert([
            'type'=>'admin',
            'name'=>'Super Admin',
            'phone'=>'01953431040',
            'email'=>'admin@demo.com',
            'password'=>bcrypt('Admin@123')
        ]);
    }
}
