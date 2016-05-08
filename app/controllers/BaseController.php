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

    /**
     * Creates a JSON as response for RESTful services
     *
     * @param $content
     * @return \Illuminate\Http\Response
     */
    protected function jsonResponse($content)
    {
        $status = 200;
        $restfulResponse = new RestfulResponse();
        $restfulResponse->setContent($content);
        $messageCenter = MessageControlCenter::getInstance();
        $restfulResponse->setSuccessMessages($messageCenter->getSuccessMessages());
        if (!empty($messageCenter->getWarningMessages())) {
            $restfulResponse->setWarningMessages($messageCenter->getWarningMessages());
            $status = 400;
        }
        if (!empty($messageCenter->getErrorMessages())) {
            $restfulResponse->setErrorMessages($messageCenter->getErrorMessages());
            $status = 500;
        }
        $messageCenter->clear();
        return Response::json($restfulResponse->toJson(), $status);
    }

    protected function isTrue($boolean)
    {
        return filter_var($boolean, FILTER_VALIDATE_BOOLEAN) == true;
    }

    protected function extractId($value)
    {
        if (!is_null($value) && is_array($value)) {
            return $value['id'];
        } else if (!is_null($value) && is_object($value)) {
            return $value->id;
        } else {
            return null;
        }
    }

    protected abstract function retrieve();
}