<?php

namespace App\Http\Middleware;

use App\Models\ChartCategories;
use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::user()->hasPermissionTo('Administer roles & permissions')) //If user has this //permission
        {
            return $next($request);
        }



        if ($request->is('chartCategories/create'))
        {
            if (!Auth::user()->hasPermissionTo('Create ChartCategories'))
            {
                abort('401');
            }
            else {
                return $next($request);
            }
        }
        if ($request->is('chartCategories/*/edit'))
        {
            if (!Auth::user()->hasPermissionTo('Edit ChartCategories')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('charts/create'))
        {
            if (!Auth::user()->hasPermissionTo('Create Charts'))
            {
                abort('401');
            }
            else {
                return $next($request);
            }
        }
        if ($request->is('charts/*/edit'))
        {
            if (!Auth::user()->hasPermissionTo('Edit Charts')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('clients/create'))
        {
            if (!Auth::user()->hasPermissionTo('Create Clients'))
            {
                abort('401');
            }
            else {
                return $next($request);
            }
        }
        if ($request->is('clients/*/edit'))
        {
            if (!Auth::user()->hasPermissionTo('Edit Clients')) {
                abort('401');
            } else {
                return $next($request);
            }
        }



        if ($request->isMethod('Delete'))
        {
            if (!Auth::user()->hasPermissionTo('Delete ChartCategories')) {
                abort('401');
            }
            else
            {
                return $next($request);
            }
            if (!Auth::user()->hasPermissionTo('Delete Charts')) {
                abort('401');
            }
            else
            {
                return $next($request);
            }

            if (!Auth::user()->hasPermissionTo('Delete Clients')) {
                abort('401');
            }
            else
            {
                return $next($request);
            }

        }

        return $next($request);
    }
}
