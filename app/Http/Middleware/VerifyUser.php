<?php

namespace App\Http\Middleware;

use Closure;

class VerifyUser
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
        $user = getUser();

        if (!$user->confirmed){
          return redirect('/')->with('warnings', ['Usuário não confirmado!']);
        }

        if ($user->locked){
          return redirect('/')->with('problems', ['Usuário bloqueado!']);
        }

        return $next($request);
    }
}
