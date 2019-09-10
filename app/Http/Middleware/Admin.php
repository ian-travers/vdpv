<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->can('manage-station')) {
            return $next($request);
        }

        return redirect(route('root'))->with([
            'message' => 'Недостаточно прав',
            'type' => 'warning'
        ]);
    }
}
