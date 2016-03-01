<?php

namespace gocrew\LaravelReAuth\Http\Middleware;

use Carbon\Carbon;
use Closure;

class Reauthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->needsReAuth($request->session())) {
            $request->session()->set('url.intended', $request->url());

            return redirect('auth/confirm');
        }

        return $next($request);
    }

    /**
     * Validate a reauthenticated Session data.
     *
     * @param \Illuminate\Session\Store $session
     *
     * @return bool
     */
    private function needsReAuth($session)
    {
        $reauthenticatedAt = Carbon::createFromTimestamp($session->get('reauthenticated.at', 0));

        return (!$session->get('reauthenticated.verified', false)) &&
            ($reauthenticatedAt > config('reauth.reauthTime'));
    }
}
