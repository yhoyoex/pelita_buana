<?php

namespace App\Listeners\Users;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class PreviousLogin {
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct(Request $request) {
    $this->request = $request;
  }

  /**
   * Handle the event.
   *
   * @param  Logout  $event
   * @return void
   */
  public function handle(Logout $event) {
    $user = $event->user;
    if(!is_null($user)) {
      $user->previous_visit_at = Carbon::now();
      $user->previous_visit_ip = $this->request->ip();
      $user->save();
    }
  }
}
