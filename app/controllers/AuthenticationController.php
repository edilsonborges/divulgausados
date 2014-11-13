<?php

class AuthenticationController extends BaseController {

	public function login()
	{
		$response = null;
		if (Auth::attempt(array('email' => Input::json('email'), 'password' => Input::json('password')))) {
			$response = Auth::user();
		} else {
		    $this->addWarningMessage('O login ou senha está incorreto(a).');
		}
		return $this->jsonResponse($response);
	}

	public function logout()
	{
		Auth::logout();
		$this->addSuccessMessage('Logout efetuado com sucesso!');
		return $this->jsonResponse(null);
	}

}