<?php
namespace App\Helpers\Fiftytwo;
 
use Illuminate\Support\Facades\DB;
 
class Settings {
    /**
     * @param int $user_id User-id
     * 
     * @return string
     */
    public static function get_settings($title) {
        $settings = DB::table('settings')->where('title', $title)->first();
         
        return (isset($settings->value) ? $settings->value : '');
    }
}