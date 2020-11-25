<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('api_token')) {
            $user = User::where('api_token', $request->input('api_token'))->first();
            if ($user)
                return $next($request);
        }

        return redirect('home');
    }
}
