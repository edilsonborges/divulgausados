<?php

class AuthenticationController extends BaseController {

	public function login() 
	{
		$response = null;
		if (Auth::attempt(array('email' => Input::json('email'), 'password' => Input::json('password')))) {
			$response = Auth::user();
		} else {
			$response = array('message' => 'O login ou senha está incorreto(a).')
		}
		return Response::json($response);
	}

	public function logout()
	{
		Auth::logout();
		return Response::json(array('message' => 'Logout efetuado com sucesso!'));
	}
	
}