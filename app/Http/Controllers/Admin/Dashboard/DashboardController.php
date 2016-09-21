<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Silber\Bouncer\Bouncer;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    public function index(Bouncer $bouncer)
    {
        $user = Auth::user();

        return view('admin.dashboard.index')->with(compact('user'));
    }
}
