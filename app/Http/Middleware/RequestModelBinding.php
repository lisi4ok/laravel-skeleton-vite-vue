<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RequestModelBinding
{
    /**
     *  Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($key = $request->route('model')) {
            $model = '\\App\\Models\\' . Str::title($key);
            if (class_exists($model)) {
                $model = new $model;
                $request->route()->setParameter('model', $model);
            }
        }

        return $next($request);
    }
}
