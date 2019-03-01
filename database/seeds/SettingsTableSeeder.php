<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      $settings = [
        ['title' => 'app_name', 'value' => 'Fifty Two Admin'],
        ['title' => 'app_desc', 'value' => 'Laravel Admin Aplication'],
        ['title' => 'app_company', 'value' => 'Fifty Two Corp.']
      ];
      foreach($settings as $setting) {
        DB::table('settings')->insert($setting);
      }
    }
}
