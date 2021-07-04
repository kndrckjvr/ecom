<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user())
        {
            switch ($request->user()->status) {
                case 1:
                case 2:
                    return redirect(route('home'));
                    break;
                
                case 3:
                    return $next($request);
                    break;
            }
        }
        return $next($request);
    }
}
