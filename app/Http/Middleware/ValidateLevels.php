<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateLevels
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        if($request->user()->active != 1){
            return redirect('/login')->withErrors(['Status Akun masih Nonaktif, coba beberapa saat lagi']);
        }elseif ( in_array($request->user()->level, $levels) ) {
            return $next($request);
        }
        // abort(403);
        return redirect('error_401','refresh');
        
    }
}
