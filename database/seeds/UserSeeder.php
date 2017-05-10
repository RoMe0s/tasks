<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = new \App\Models\User();

        $admin->fill([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin'
        ]);

        $admin->save();

        factory(\App\Models\User::class, 50)->create();
    }
}
