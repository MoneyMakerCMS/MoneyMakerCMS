<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Support\Facades\Auth;
use Silber\Bouncer\Bouncer;

class DashboardController
{
    public function index(Bouncer $bouncer)
    {
        $user = Auth::user();

        return view('admin.dashboard.index')->with(compact('user'));
    }
}
