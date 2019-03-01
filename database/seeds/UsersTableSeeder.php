<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      DB::table('users')->insert([
        'active' => 1,
        'name' => 'Root',
        'username' => 'root',
        'email' => 'root@root.com',
        'password' => '$2y$10$KYeW0GykOAEeBekegROzLe1kmGHv4llsoisfH5PoytB99LRqf6y2O', //123
      ]);
      DB::table('users')->insert([
        'active' => 1,
        'name' => 'Owner',
        'username' => 'owner',
        'email' => 'owner@owner.com',
        'password' => '$2y$10$KYeW0GykOAEeBekegROzLe1kmGHv4llsoisfH5PoytB99LRqf6y2O', //123
      ]);
      DB::table('users')->insert([
        'active' => 1,
        'name' => 'Admin',
        'username' => 'admin',
        'email' => 'admin@admin.com',
        'password' => '$2y$10$KYeW0GykOAEeBekegROzLe1kmGHv4llsoisfH5PoytB99LRqf6y2O', //123
      ]);

      DB::table('roles')->insert([
        'name' => 'root',
        'display_name' => 'Root',
        'description' => 'Top User Level',
      ]);
      DB::table('roles')->insert([
        'name' => 'owner',
        'display_name' => 'Owner',
        'description' => 'Owner User Level',
      ]);
      DB::table('roles')->insert([
        'name' => 'admin',
        'display_name' => 'Admin',
        'description' => 'Admin User Level',
      ]);

      $user_id_root = App\User::where('username', '=', 'root')->first()->id;
      $role_id_root = App\Role::where('name', '=', 'root')->first()->id;
      $user_id_owner = App\User::where('username', '=', 'owner')->first()->id;
      $role_id_owner = App\Role::where('name', '=', 'owner')->first()->id;
      $user_id_admin = App\User::where('username', '=', 'admin')->first()->id;
      $role_id_admin = App\Role::where('name', '=', 'admin')->first()->id;
      DB::table('role_user')->insert([
        'user_id' => $user_id_root,
        'role_id' => $role_id_root
      ]);
      DB::table('role_user')->insert([
        'user_id' => $user_id_owner,
        'role_id' => $role_id_owner
      ]);
      DB::table('role_user')->insert([
        'user_id' => $user_id_admin,
        'role_id' => $role_id_admin
      ]);
    }
}
