<?php

namespace App\Http\Controllers\Admin;

use Silber\Bouncer\Bouncer;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    public function __construct()
    {
    }

    public function index(Bouncer $bouncer)
    {
        // dd($bouncer->ability());
        $user = Auth::user();
        // $bouncer->retract('SuperAdmin')->from($user);
        // Bouncer::assign('SuperAdmin')->to($user);

        return view('admin.dashboard.index')->with(compact('user'));
    }
}
