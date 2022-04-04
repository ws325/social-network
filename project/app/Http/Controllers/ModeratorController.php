<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ModeratorController extends Controller
{
public function block(Request $request)
{
    $user = User::findOrFail($request->user);
    if($user->block)
    {
        $user->block=false;
        $user->block_end=NULL;
    }
    else
    {
        $user->block=true;
        $user->warnings=0;
        $user->block_end=Carbon::now()->addDays(3);
    }
    $user->save();
    return view('dashboardmod');
}

    public function warn(Request $request)
    {
        $user = User::findOrFail($request->user);
        if($user->warnings==2) $this->block($request);
        else
        {
            $user->warnings=$user->warnings+1;
            $user->save();
            $notification = new Notification();
            $rest=2-$user->warnings;
            $notification->message = "Admin ".Auth::user()->nick." dał Ci ostrzeżenie. Zostały ci ".$rest." przed zablokowaniem konta na 3 dni";
            $notification->user_id = $request->user;
            $notification->save();
        }
        return view('dashboardmod');

    }

}

