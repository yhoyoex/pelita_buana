<?php

namespace App\Http\Controllers\Programs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notifiable;
use Response;

class NotificationController extends Controller {
    
    public function read($id) {
        $user = \Auth::user();
        $notification = $user->notifications()->where('id',$id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        return Response::json(['responseText' => 'Success'], 200);
    }
}
