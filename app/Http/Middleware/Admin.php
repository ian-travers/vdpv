<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->isAdmin()) {
            return $next($request);
        }

        return redirect(route('root'))->with([
            'message' => 'Недостаточно прав',
            'type' => 'warning'
        ]);
    }
}
