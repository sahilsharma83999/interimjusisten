<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class IsAdmin
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
        if(Auth::guest()) {
            return redirect('/')->with('infoMsg','Bitte einloggen');
        } else if( !Auth::user()->admin) {
            return redirect('/')->with('infoMsg','Administrator Zugang erforderlich');
        }
        return $next($request);
    }
}
