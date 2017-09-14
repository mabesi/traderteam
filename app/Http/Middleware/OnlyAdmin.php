<?php

namespace App\Http\Middleware;

use Closure;

class OnlyAdmin
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
      if (!isAdmin()){
        return back()->with('warnings', ['Acesso autorizado somente para administradores!']);
      }

      return $next($request);
    }
}
