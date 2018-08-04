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

        DB::table('users')->insert(
            [
                [
                    'name' => 'admin',
                    'email' => 'admin@admin.fr',
                    'password' => Hash::make('admin'),
                    'elevation' => "admin"
                ],
                [
                    'name' => 'julien',
                    'email' => 'julien@lem.com',
                    'password' => Hash::make('Azerty77'),
                    'elevation' => "user"

                ],
                [
                    'name' => 'amelie',
                    'email' => 'amelie@lem.com',
                    'password' => Hash::make('Azerty77'),
                    'elevation' => "user"

                ]
            ]
        );
        //
    }
}
