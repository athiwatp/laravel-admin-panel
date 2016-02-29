<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'super',
            'full_name' => 'Super Administrator',
            'description' => 'Administrative user, has access to everything',
            'position' => '1',
            'visible' => '1',
            'level' => '1000'
        ]);

        DB::table('roles')->insert([
            'name' => 'normal',
            'full_name' => 'Normal Administrator',
            'description' => 'Administrative user, has access to almost everything',
            'position' => '2',
            'visible' => '1',
            'level' => '900'
        ]);
    }
}
