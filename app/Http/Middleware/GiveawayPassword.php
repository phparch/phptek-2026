<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GiveawayPassword
{
    public function handle(Request $request, Closure $next): Response
    {
        $expected = config('tek.giveaway.password');

        if (empty($expected)) {
            return $next($request);
        }

        if ($request->session()->get('giveaway_authed') === true) {
            return $next($request);
        }

        return redirect()->route('giveaway.unlock');
    }
}
