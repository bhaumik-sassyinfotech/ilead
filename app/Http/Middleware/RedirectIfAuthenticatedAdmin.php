<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
	 public function handle($request, Closure $next)
    {
    //If request comes from logged in user, he will
      //be redirect to profile page.
      if (Auth::guard()->check()) {
          return redirect('/account');
      }

      //If request comes from logged in admin, he will
      //be redirected to admin's dashboard page.
      if (Auth::guard('admin')->check()) {
          return redirect('/admin/dashboard');
      }
      return $next($request); 
	}
}
