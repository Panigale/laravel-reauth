<?php

namespace gocrew\LaravelReAuth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait Reauthenticates
{
    /**
     * Show the Re-Auth form.
     *
     * @return \Illuminate\View\View
     */
    public function getReauthenticate()
    {
        $view = property_exists($this, 'reauthView')
            ? $this->loginView
            : 'auth.reauthenticate';

        if (view()->exists($view)) {
            return view($view);
        }

        return view('gocrew::reauthenticate');
    }

    /**
     * Handle the reauthentication request to the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postReauthenticate(Request $request)
    {
        $this->validateLogin($request);

        if (Hash::check(
            $request->{$this->authEntity()},
            Auth::guard($this->getGuard())->user()->getAuthPassword()
        )) {
            return $this->handleUserVerifiedAuthentication($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user re-auth request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->authEntity() => 'required',
        ]);
    }

    /**
     * Send the response after the user was re-authenticated.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    protected function handleUserVerifiedAuthentication(Request $request)
    {
        $this->rememberReAuthVerification();

        if (method_exists($this, 'reauthenticated')) {
            return $this->reauthenticated($request, Auth::guard($this->getGuard())->user());
        }

        return redirect()->intended('/');
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withErrors([
                $this->authEntity() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Remember re-auth verification.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    protected function rememberReAuthVerification(Request $request)
    {
        $request->session()->set('reauthenticated.at', Carbon::now()->timestamp);
        $request->session()->set('reauthenticated.verified', true);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return trans()->has('auth.failed')
                ? trans('auth.failed')
                : 'These credentials do not match our records.';
    }

   /**
    * Get the login entity to be used by the controller.
    *
    * @return string
    */
   public function authEntity()
   {
       return property_exists($this, 'authEntity')
           ? $this->authEntity
           : 'password';
   }

    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}
