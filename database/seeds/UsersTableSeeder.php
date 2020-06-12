<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'role_id' => '1',
            'name' => 'Uchechukwu.Admin',
            // 'name' => 'MD.Admin',
            'username' => 'ucking44',
            // 'email' => 'admin@blog.com',
            'email' => 'ucking4niga@yahoo.com',
            'password' => bcrypt('ucking44'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'Kingsley.Author',
            // 'name' => 'MD.Author',
            'username' => 'ucking77',
            // 'username' => 'author',
            'email' => 'ucking44@gmail.com',
            'password' => bcrypt('ucking44'),
        ]);
    }
}
