<?php

namespace App\Http\Middleware;

use Closure;

class OnlySuperAdmin
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
      if (!isSuperAdmin()){
        return back()->with('problems', ['Acesso autorizado somente para super administradores!']);
      }
      return $next($request);
    }
}
