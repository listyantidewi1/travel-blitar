<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class checkapi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $query = User::where("remember_token", $request->token);
        if (!$query->exists()) {
            return response()->json([
                'message' => 'Unauthorized user',
            ], 401);
        }

        if(($request->isMethod("POST") || $request->isMethod("DELETE")) && ($query->value("roles") != "admin")){
            return response()->json([
                'message' => 'Unauthorized user',
            ], 401);
        }
        return $next($request);
    }
}
