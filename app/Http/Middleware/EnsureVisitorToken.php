<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class EnsureVisitorToken
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('visitor_token')) {
            $request->session()->put('visitor_token', (string) Str::uuid());
        }

        $request->attributes->set('visitor_token', $request->session()->get('visitor_token'));

        return $next($request);
    }
}
