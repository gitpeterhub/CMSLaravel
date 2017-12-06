<?php

use Illuminate\Database\Seeder;
use App\Models\User as User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::truncate();
        //factory(App\Models\User::class,25)->create();

        User::create(array(
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'username' => 'admin',
                'user_type' => 0,
                'approved' => 1,
                'verified' => 1,
                'email' => 'admin@admin.com',
                'password' => bcrypt('secret'),
        ));
    }
}
