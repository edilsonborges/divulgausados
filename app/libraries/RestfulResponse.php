<?php

/**
 * Represents the RESTful API service response
 */
class RestfulResponse
{

    private $successMessages;

    private $warningMessages;

    private $errorMessages;

    private $userInfo;

    private $data;

    public function getSuccessMessages()
    {
        return $this->successMessages;
    }

    public function setSuccessMessages(ViewMessageHolder $successMessages)
    {
        $this->successMessages = $successMessages;
    }

    public function getWarningMessages()
    {
        return $this->warningMessages;
    }

    public function setWarningMessages($warningMessages)
    {
        $this->warningMessages = $warningMessages;
    }

    public function getErrorMessages()
    {
        return $this->errorMessages;
    }

    public function setErrorMessages(ViewMessageHolder $errorMessages)
    {
        $this->errorMessages = $errorMessages;
    }

    public function getUserInfo()
    {
        return $this->userInfo;
    }

    public function setUserInfo($userInfo)
    {
        $this->userInfo = $userInfo;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}
