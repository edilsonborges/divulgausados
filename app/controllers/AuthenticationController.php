<?php

class AuthenticationController extends BaseController
{

    public function login()
    {
        $service = new UserService();
        $credentials = $this->retrieve();
        if ($service->login($credentials['email'], $credentials['password'])) {
            MessageControlCenter::getInstance()->addSuccessMessage('Bem vindo(a) ' . Auth::user()->name);
        } else {
            MessageControlCenter::getInstance()->addWarningMessage('O login ou senha está incorreto(a).');
        }
        return $this->jsonResponse(null);
    }

    public function logout()
    {
        Auth::logout();
        MessageControlCenter::getInstance()->addSuccessMessage('Logout efetuado com sucesso!');
        return $this->jsonResponse(null);
    }

    protected function retrieve()
    {
        return [
            'email' => Input::json('email'),
            'password' => Input::json('password')
        ];
    }

}