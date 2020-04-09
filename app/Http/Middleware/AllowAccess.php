<?php

namespace App\Http\Middleware;

class AllowAccess {

    public function handle($request, \Closure $next){

        return $next($request)
            ->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization')
            ->header('Access-Control-Allow-Origin', '*');
    }

}
