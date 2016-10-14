<?php

namespace App\Http\Middleware;

use Bouncer;
use Closure;

class CheckPermission
{
    /**
         * Handle an incoming request.
         *
         * @param \Illuminate\Http\Request $request
         * @param \Closure                 $next
         *
         * @return mixed
         */
        public function handle($request, Closure $next, $permission)
        {
            if (!Bouncer::allows($permission)) {
                return redirect('/');
            }

            return $next($request);
        }
}
