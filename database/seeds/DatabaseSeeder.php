<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        /* User::truncate();
        factory(App\User::class,5)->create();*/
        Eloquent::unguard();
        //we can can call another seeder class as
        $this->call('UsersTableSeeder'); //this is by default*/
    }
}
