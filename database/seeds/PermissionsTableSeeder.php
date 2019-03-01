<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      $menu_akses_id = App\Menu::where('name', '=', 'Akses')->first()->id;
      $menu_user_id = App\Menu::where('name', '=', 'User')->first()->id;
      $menu_role_id = App\Menu::where('name', '=', 'Roles')->first()->id;
      $menu_settings_id = App\Menu::where('name', '=', 'Settings')->first()->id;
      $menu_backup_id = App\Menu::where('name', '=', 'Backup')->first()->id;
      $menu_log_id = App\Menu::where('name', '=', 'Log')->first()->id;
      $permissions = [
        // Akses
        ['menu_id' => $menu_akses_id,'name' => 'view-menu-access', 'display_name' => 'Menu Access', 'description' => 'User can view access menu'],
        //User
        ['menu_id' => $menu_user_id, 'name' => 'view-menu-user', 'display_name' => 'Menu User', 'description' => 'User can view user menu'],
        ['menu_id' => $menu_user_id, 'name' => 'list-user', 'display_name' => 'List User', 'description' => 'User can view user list'],
        ['menu_id' => $menu_user_id, 'name' => 'add-user', 'display_name' => 'Tambah User', 'description' => 'User can tambah user'],
        ['menu_id' => $menu_user_id, 'name' => 'edit-user', 'display_name' => 'Edit User', 'description' => 'User can edit user'],
        ['menu_id' => $menu_user_id, 'name' => 'delete-user', 'display_name' => 'Hapus User', 'description' => 'User can hapus user'],
        //Roles
        ['menu_id' => $menu_role_id, 'name' => 'view-menu-roles', 'display_name' => 'Menu Roles', 'description' => 'User can view roles menu'],
        ['menu_id' => $menu_role_id, 'name' => 'list-role', 'display_name' => 'List Role', 'description' => 'User can view role list'],
        ['menu_id' => $menu_role_id, 'name' => 'add-role', 'display_name' => 'Tambah Role', 'description' => 'User can tambah role'],
        ['menu_id' => $menu_role_id, 'name' => 'edit-role', 'display_name' => 'Edit Role', 'description' => 'User can edit role'],
        ['menu_id' => $menu_role_id, 'name' => 'delete-role', 'display_name' => 'Hapus Role', 'description' => 'User can hapus role'],
        //Log
        ['menu_id' => $menu_log_id, 'name' => 'view-menu-log', 'display_name' => 'Menu Log', 'description' => 'User can view log menu'],
        ['menu_id' => $menu_log_id, 'name' => 'list-log', 'display_name' => 'List Log', 'description' => 'User can view log list'],
        ['menu_id' => $menu_log_id, 'name' => 'view-log', 'display_name' => 'View Log', 'description' => 'User can view log'],
        ['menu_id' => $menu_log_id, 'name' => 'clear-log', 'display_name' => 'Clear Log', 'description' => 'User can clear log'],
        ['menu_id' => $menu_log_id, 'name' => 'delete-log', 'display_name' => 'Delete Log', 'description' => 'User can delete log'],
        // Backup
        ['menu_id' => $menu_backup_id, 'name' => 'view-menu-backup', 'display_name' => 'Menu Backup', 'description' => 'User can view backup menu'],
        ['menu_id' => $menu_backup_id, 'name' => 'list-backup', 'display_name' => 'List Backup', 'description' => 'User can view backup list'],
        ['menu_id' => $menu_backup_id, 'name' => 'backup-database', 'display_name' => 'Backup Database', 'description' => 'User can backup database'],
        ['menu_id' => $menu_backup_id, 'name' => 'restore-database', 'display_name' => 'Restore Database', 'description' => 'User can restore database'],
        ['menu_id' => $menu_backup_id, 'name' => 'download-database', 'display_name' => 'Download Database', 'description' => 'User can download database'],
        ['menu_id' => $menu_backup_id, 'name' => 'delete-database', 'display_name' => 'Delete Database', 'description' => 'User can delete database'],
        // Settings
        ['menu_id' => $menu_settings_id, 'name' => 'view-menu-settings', 'display_name' => 'Menu Settings', 'description' => 'User can view settings menu'],
        ['menu_id' => $menu_settings_id, 'name' => 'edit-settings', 'display_name' => 'Edit Settings', 'description' => 'User can view edit settings'],
      ];

      foreach($permissions as $permission) {
        DB::table('permissions')->insert($permission);
      }
    }
}
