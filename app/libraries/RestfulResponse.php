<?php

use Illuminate\Database\Eloquent\Collection;

/**
 * Represents the RESTful API service response
 */
class RestfulResponse
{
    private $response;

    public function __construct()
    {
        $this->response = new Collection();
    }

    public function getSuccessMessages()
    {
        return $this->response['successMessages'];
    }

    public function setSuccessMessages(array $successMessages)
    {
        $this->response['successMessages'] = $successMessages;
    }

    public function getWarningMessages()
    {
        return $this->response['warningMessages'];
    }

    public function setWarningMessages(array $warningMessages)
    {
        $this->response['warningMessages'] = $warningMessages;
    }

    public function getErrorMessages()
    {
        return $this->response['errorMessages'];
    }

    public function setErrorMessages(array $errorMessages)
    {
        $this->response['errorMessages'] = $errorMessages;
    }

    public function getContent()
    {
        return $this->response['content'];
    }

    public function setContent($content)
    {
        $this->response['content'] = $content;
    }

    public function toJson()
    {
        return $this->response;
    }
}