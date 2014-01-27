<?php

class AuthController extends BaseController {

	public function getLogin()
	{
		return View::make('auth.login');
	}

	public function postLogin()
	{
		if (Auth::attempt(array('email' => Input::get('mail'), 'password' => Input::get('password')))) {
			return Redirect::intended('/');
		} else {
			return Redirect::to('auth/login')
	            ->with('flash_error', 'Your email/password combination was incorrect.')
	            ->withInput();
		}
	}

	public function getLogout()
	{
		Auth::logout();

		return Redirect::to('/');
	}

}