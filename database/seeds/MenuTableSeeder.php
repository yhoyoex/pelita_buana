<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      DB::table('menu')->insert([
        'active' => '1',
        'order' => '20',
        'name' => 'Akses',
        'icon' => 'fas fa-unlock',
      ]);
      $akses_id = App\Menu::where('name', '=', 'Akses')->first()->id;
      DB::table('menu')->insert([
        'active' => '1',
        'order' => '1',
        'name' => 'User',
        'url' => 'users',
        'parent_id' => $akses_id
      ]);
      DB::table('menu')->insert([
        'active' => '1',
        'order' => '2',
        'name' => 'Roles',
        'url' => 'roles',
        'parent_id' => $akses_id
      ]);
      DB::table('menu')->insert([
        'active' => '1',
        'order' => '21',
        'name' => 'Settings',
        'url' => 'settings',
        'icon' => 'fas fa-cog',
      ]);
      DB::table('menu')->insert([
        'active' => '1',
        'order' => '22',
        'name' => 'Backup',
        'url' => 'backup',
        'icon' => 'far fa-arrow-alt-circle-down',
      ]);
      DB::table('menu')->insert([
        'active' => '1',
        'order' => '23',
        'name' => 'Log',
        'url' => 'activity-log',
        'icon' => 'fas fa-binoculars',
      ]);
    }
}
