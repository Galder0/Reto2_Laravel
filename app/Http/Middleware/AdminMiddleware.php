<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the authenticated user has the 'admin' role
        if ($request->user() && $request->user()->hasRole('admin')) {
            return $next($request);
        }

        // Redirect to unauthorized page or perform other actions
        abort(403, 'Unauthorized action.');

        // Alternatively, you can redirect to a different route
        // return redirect('/home');
    }
}