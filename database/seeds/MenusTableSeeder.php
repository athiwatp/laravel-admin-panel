<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            'parent_id' => NULL,
            'section' => 'admin',
            'name' => 'Users',
            'route' => 'users',
            'position' => 1
        ]);

        DB::table('menus')->insert([
            'parent_id' => 1,
            'section' => 'admin',
            'name' => 'Admin',
            'route' => 'users/administrator',
            'position' => 1,
            'default' => 1,
        ]);

        DB::table('menus')->insert([
            'parent_id' => 1,
            'section' => 'admin',
            'name' => 'Roles',
            'route' => 'users/roles',
            'position' => 2,
            'default' => 0,
        ]);

        DB::table('menus')->insert([
            'parent_id' => NULL,
            'section' => 'admin',
            'name' => 'Test',
            'route' => 'test',
            'position' => 2
        ]);
    }
}
