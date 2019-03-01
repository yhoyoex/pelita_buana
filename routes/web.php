<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Public

Route::get('/', ['as'=>'home.index','uses'=>'HomesController@index']);
Route::get('about', ['as'=>'home.about','uses'=>'HomesController@about']);
Route::get('blog-list', ['as'=>'home.blog-list','uses'=>'HomesController@blogList']);
Route::get('galery', ['as'=>'home.galery','uses'=>'HomesController@galery']);
Route::get('announcement', ['as'=>'home.announcement','uses'=>'HomesController@announcement']);
Route::get('contact', ['as'=>'home.contact','uses'=>'HomesController@contact']);


Route::get('login-status', ['as'=>'login_status','uses'=>'Auth\LoginController@getLoginStatus']);
Auth::routes();
Route::get('home', ['as'=>'home','uses'=>'AdminController@index']);
Route::get('dashboard', ['as'=>'dashboard','uses'=>'Dashboard\DashboardController@index']);

Route::get('logout', ['as'=>'logout','uses'=>'Auth\LoginController@logout']);

//-------------------------------------------------------------------------------------------------------------------------------------------
// Access
//-------------------------------------------------------------------------------------------------------------------------------------------

// Users
Route::get('users',['as'=>'users','uses'=>'Access\UsersController@index','middleware' => ['ability:root,view-menu-user','ajax']]);
Route::get('users/list',['as'=>'users.list','uses'=>'Access\UsersController@list','middleware' => ['ability:root,list-user','ajax']]);
Route::get('users/create',['as'=>'users.create','uses'=>'Access\UsersController@create','middleware' => ['ability:root,add-user','ajax']]);
Route::post('users/store',['as'=>'users.store','uses'=>'Access\UsersController@store','middleware' => ['ability:root,add-user','ajax']]);
Route::get('users/{id}/edit',['as'=>'users.edit','uses'=>'Access\UsersController@edit','middleware' => ['ability:root,edit-user','ajax']]);
Route::patch('users/{id}',['as'=>'users.update','uses'=>'Access\UsersController@update','middleware' => ['ability:root,edit-user','ajax']]);
Route::delete('users/{id}',['as'=>'users.delete','uses'=>'Access\UsersController@destroy','middleware' => ['ability:root,delete-user','ajax']]);

// Role
Route::get('roles',['as'=>'roles','uses'=>'Access\RoleController@index','middleware' => ['ability:root,view-menu-roles','ajax']]);
Route::get('roles/list',['as'=>'roles.list','uses'=>'Access\RoleController@list','middleware' => ['ability:root,list-role','ajax']]);
Route::get('roles/create',['as'=>'roles.create','uses'=>'Access\RoleController@create','middleware' => ['ability:root,add-role','ajax']]);
Route::post('roles/store',['as'=>'roles.store','uses'=>'Access\RoleController@store','middleware' => ['ability:root,add-role','ajax']]);
Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'Access\RoleController@edit','middleware' => ['ability:root,edit-role','ajax']]);
Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'Access\RoleController@update','middleware' => ['ability:root,edit-role','ajax']]);
Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'Access\RoleController@destroy','middleware' => ['ability:root,delete-role','ajax']]);

//-------------------------------------------------------------------------------------------------------------------------------------------
// Logs
//-------------------------------------------------------------------------------------------------------------------------------------------
Route::get('activity-log',['as'=>'activitylog','uses'=>'Logs\ActivitylogController@index','middleware' => ['ability:root,view-menu-log','ajax']]);
Route::get('activity-log/list',['as'=>'activitylog.list','uses'=>'Logs\ActivitylogController@list','middleware' => ['ability:root,list-log','ajax']]);
Route::get('activity-log/view/{id}',['as'=>'activitylog.view','uses'=>'Logs\ActivitylogController@view','middleware' => ['ability:root,lihat-log','ajax']]);
Route::delete('activity-log/{id}',['as'=>'activitylog.delete','uses'=>'Logs\ActivitylogController@destroy','middleware' => ['ability:root,delete-log','ajax']]);
Route::get('activity-log/clean-logs',['as'=>'activitylog.clear','uses'=>'Logs\ActivitylogController@clean','middleware' => ['ability:root,bersihkan-log','ajax']]);

//-------------------------------------------------------------------------------------------------------------------------------------------
// Programs
//-------------------------------------------------------------------------------------------------------------------------------------------

// Bugs Report
Route::get('bugs-report/create',['as'=>'bugs-report.create','uses'=>'Programs\TaskListController@bugs_report_create']);
Route::post('bugs-report/store',['as'=>'bugs-report.store','uses'=>'Programs\TaskListController@bugs_report_store']);

// Menu
Route::get('menu',['as'=>'menu','uses'=>'Programs\MenuController@index','middleware' => ['role:root']]);
Route::get('menu/list',['as'=>'menu.list','uses'=>'Programs\MenuController@list','middleware' => ['role:root','ajax']]);
Route::get('menu/create',['as'=>'menu.create','uses'=>'Programs\MenuController@create','middleware' => ['role:root']]);
Route::post('menu/store',['as'=>'menu.store','uses'=>'Programs\MenuController@store','middleware' => ['role:root']]);
Route::get('menu/{id}/edit',['as'=>'menu.edit','uses'=>'Programs\MenuController@edit','middleware' => ['role:root']]);
Route::patch('menu/{id}',['as'=>'menu.update','uses'=>'Programs\MenuController@update','middleware' => ['role:root']]);
Route::delete('menu/{id}',['as'=>'menu.delete','uses'=>'Programs\MenuController@destroy','middleware' => ['role:root']]);

// Permission
Route::get('hak-akses',['as'=>'hak-akses','middleware' => ['role:root'],'uses'=>'Programs\PermissionController@index']);
Route::get('hak-akses/list',['as'=>'hak-akses.list','middleware' => ['role:root','ajax'],'uses'=>'Programs\PermissionController@list']);
Route::get('hak-akses/list/{menu}',['as'=>'hak-akses.list.menu','middleware' => ['role:root','ajax'],'uses'=>'Programs\PermissionController@list']);
Route::get('hak-akses/create',['as'=>'hak-akses.create','middleware' => ['role:root'],'uses'=>'Programs\PermissionController@create']);
Route::post('hak-akses/store',['as'=>'hak-akses.store','middleware' => ['role:root'],'uses'=>'Programs\PermissionController@store']);
Route::get('hak-akses/{id}/edit',['as'=>'hak-akses.edit','middleware' => ['role:root'],'uses'=>'Programs\PermissionController@edit']);
Route::patch('hak-akses/{id}',['as'=>'hak-akses.update','middleware' => ['role:root'],'uses'=>'Programs\PermissionController@update']);
Route::delete('hak-akses/{id}',['as'=>'hak-akses.delete','middleware' => ['role:root'],'uses'=>'Programs\PermissionController@destroy']);

// Task Lisk
Route::get('task-list',['as'=>'task-list','uses'=>'Programs\TaskListController@index','middleware' => ['role:root','ajax']]);
Route::get('task-list/total',['as'=>'task-list.total','uses'=>'Programs\TaskListController@total','middleware' => ['role:root','ajax']]);
Route::get('task-list/list',['as'=>'task-list.list','uses'=>'Programs\TaskListController@list','middleware' => ['role:root','ajax']]);
Route::get('task-list/create',['as'=>'task-list.create','uses'=>'Programs\TaskListController@create','middleware' => ['role:root','ajax']]);
Route::post('task-list/store',['as'=>'task-list.store','uses'=>'Programs\TaskListController@store','middleware' => ['role:root','ajax']]);
Route::get('task-list/{id}/edit',['as'=>'task-list.edit','uses'=>'Programs\TaskListController@edit','middleware' => ['role:root','ajax']]);
Route::patch('task-list/{id}',['as'=>'task-list.update','uses'=>'Programs\TaskListController@update','middleware' => ['role:root','ajax']]);
Route::delete('task-list/{id}',['as'=>'task-list.delete','uses'=>'Programs\TaskListController@destroy','middleware' => ['role:root','ajax']]);

// Editor
Route::get('editor',['as'=>'editor','middleware' => ['role:root'],'uses'=>'Programs\CodeEditorController@index']);
Route::post('editor_get_dir',['as'=>'editor_get_dir','middleware' => ['role:root'],'uses'=>'Programs\CodeEditorController@get_dir']);
Route::post('editor_get_file',['as'=>'editor_get_file','middleware' => ['role:root'],'uses'=>'Programs\CodeEditorController@get_file']);
Route::post('editor_save_file',['as'=>'editor_save_file','middleware' => ['role:root'],'uses'=>'Programs\CodeEditorController@save_file']);

// System Logs
Route::get('system-logs',['as'=>'system-logs','middleware' => ['role:root'],'uses'=>'Programs\SystemLogsController@index']);
Route::get('system-logs/get-total',['as'=>'system-logs.get-total','middleware' => ['role:root'],'uses'=>'Programs\SystemLogsController@index']);

// Profile
Route::get('profile',['as'=>'profile','uses'=>'Programs\ProfileController@index']);
Route::post('profile/photo/store',['as'=>'profile.photo_store','uses'=>'Programs\ProfileController@update_pictures']);
Route::post('profile/update_field',['as'=>'update_field','uses'=>'Programs\ProfileController@update_field']);
Route::get('profile/update_password',['as'=>'profile.update_password','uses'=>'Programs\ProfileController@update_password']);
Route::post('profile/store_password',['as'=>'profile.store_password','uses'=>'Programs\ProfileController@store_password']);
Route::get('profile/load-activity/{offset}',['as'=>'profile.load.activity','uses'=>'Programs\ProfileController@loadMoreActivity']);

//-------------------------------------------------------------------------------------------------------------------------------------------
// Backup
//-------------------------------------------------------------------------------------------------------------------------------------------
Route::get('backup',['as'=>'backup', 'uses'=>'Backup\BackupController@index','middleware' => ['ability:root,view-menu-backup','ajax']]);
Route::get('backup/list',['as'=>'backup.list','uses'=>'Backup\BackupController@list','middleware' => ['ability:root,list-backup','ajax']]);
Route::get('backup/backup',['as'=>'backup.backup','uses'=>'Backup\BackupController@backup','middleware' => ['ability:root,backup-database','ajax']]);
Route::get('backup/restore/{name}',['as'=>'backup.restore','uses'=>'Backup\BackupController@restore','middleware' => ['ability:root,restore-database','ajax']]);
Route::get('backup/download/{name}',['as'=>'backup.download','uses'=>'Backup\BackupController@download','middleware' => ['ability:root,download-database','ajax']]);
Route::delete('backup/{name}',['as'=>'backup.delete','uses'=>'Backup\BackupController@destroy','middleware' => ['ability:root,delete-backup','ajax']]);

//-------------------------------------------------------------------------------------------------------------------------------------------
// Settings
//-------------------------------------------------------------------------------------------------------------------------------------------
Route::get('settings',['as'=>'settings','uses'=>'Settings\SettingsController@index','middleware' => ['ability:root,view-menu-pengaturan','ajax']]);
Route::post('settings-update',['as'=>'settings.update','uses'=>'Settings\SettingsController@update','middleware' => ['ability:root,edit-pengaturan','ajax']]);
