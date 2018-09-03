<?php

namespace App\Http\Middleware;

use Closure;

class CheckActivationStatus
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
        if (empty(auth()->user()->activated_at)) {
            return redirect()->route('account.activation');
        }
        return $next($request);
    }
}
