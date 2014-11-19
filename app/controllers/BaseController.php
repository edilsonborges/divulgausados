<?php

abstract class BaseController extends Controller
{

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    protected function jsonResponse($content)
    {
        $restfulResponse = new RestfulResponse();
        $restfulResponse->setContent($content);
        $messageCenter = MessageControlCenter::getInstance();
        $restfulResponse->setSuccessMessages($messageCenter->getSuccessMessages());
        $restfulResponse->setWarningMessages($messageCenter->getWarningMessages());
        $restfulResponse->setErrorMessages($messageCenter->getErrorMessages());
        $messageCenter->clear();
        return $restfulResponse->toJson();
    }

    protected function isTrue($boolean)
    {
        return filter_var($boolean, FILTER_VALIDATE_BOOLEAN) == true;
    }

    protected abstract function retrieve();

}
