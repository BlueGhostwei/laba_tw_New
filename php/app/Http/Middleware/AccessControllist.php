<?php

namespace App\Http\Middleware;

use Closure;
use Response;
use Redirect;

class AccessControllist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

     
        if (!acl()) {
            if ($request->ajax()) {
                return Response::json([
                    'statue' => 1,
                    'message' => '您无权访问此页面',
                ]);
            }

            return Redirect::to($request->header('referer', '/'))->withErrors('您无权访问此页面');
        }
        return $next($request);
    }
}
