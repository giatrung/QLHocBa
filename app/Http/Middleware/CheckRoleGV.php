<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleGV
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
        // $gv_request = request()->user();

        // if ($gv_request->role == 0) {
        //     return $next($request);
        // } else {
        //     return response()->json([
        //         'errors' => "You are not the GV",
        //         'status_code' => 412
        //     ], 412);
        // }
        if(Auth::check() && Auth::user()->role==0){
            return $next($request);
        }
        else{
            redirect('/home');
        }
        
    }
}
