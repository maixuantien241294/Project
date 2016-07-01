<?php namespace App\Http\Middleware;

use Closure;
use Sentry;

class SentryCheck {

    /**
   * Sentry - Check login status
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {

    if (Sentry::check())
    {
      return $next($request);
    }

    \Session::put('loginRedirect', \Request::url());
    return \Redirect::route('backend.login');
  }
}