<?php

namespace App\Http\Controllers;

use App\Requests\LoginRequest;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{

    /***
     * Shows the login page
     * @return Application|Factory|View
     * @method GET
     * @route /login
     */
    public function index()
    {
        return view('auth.login');
    }

    /***
     * Validates the login form and logs the user in
     * @param LoginRequest $request
     * @return RedirectResponse
     * @method POST
     * @route /login
     */
    public function postLogin(LoginRequest $request): RedirectResponse
    {
        // If the validation fails, the user will be redirected to login with an error message
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return redirect()
                ->route('home')
                ->with('success', __('Successfully logged in'));
        }

        //If the credentials are wrong, the user will be redirected to login with a neutral error message
        //It won't tell the user if the username or password is wrong or either the user even exists
        return redirect()
            ->route('login')
            ->with('error', __('Error while logging in'));
    }

    /***
     * Logs the user out and redirects him to the home-page
     * @return RedirectResponse
     * @method GET
     * @route /logout
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()
            ->route('login')
            ->with('success', __('Successfully logged out'));
    }
}
