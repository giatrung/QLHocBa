<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;

class Login
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
           $admin_request = request()->user();
           
           if ($admin_request->getTable() === 'administrators') {
              return $next($request);

           }else{
            return response()->json([
                'errors' => "You are not an administrator",
                'status_code' => 412
            ], 412);

           }

    }
}
