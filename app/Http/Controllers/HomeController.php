<?php

namespace App\Http\Controllers;

use App\Models\Access\User;
use Bouncer;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $check = Bouncer::allows('view-admin', User::class);
        // $user = Auth::user();
        // $check = Bouncer::allows('view-admin');
        // dd($check);
        // dd($user->abilities()->count());
        // $check = $user->can('view-admin', User::class);
        // dd($check);
        return view('home');
    }
}
