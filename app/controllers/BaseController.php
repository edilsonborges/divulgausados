<?php

class BaseController extends Controller
{

    const DISPLAY_PAGE_SIZE = 10;

    private $errorMessageHolder;

    private $warningMessageHolder;

    private $successMessageHolder;

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (! is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    protected function jsonResponse($data)
    {
        $restfulResponse = new RestfulResponse();
        $restfulResponse->setData($data);
        $restfulResponse->setSuccessMessages($this->getSuccessMessageHolder()
            ->toArray());
        $restfulResponse->setWarningMessages($this->getWarningMessageHolder()
            ->toArray());
        $restfulResponse->setErrorMessages($this->getErrorMessageHolder()
            ->toArray());
        return Response::json($restfulResponse);
    }

    protected function getSuccessMessageHolder()
    {
        if (is_null($this->successMessageHolder)) {
            $this->successMessageHolder = ViewMessageHolder::getInstance(ViewMessageStatus::SUCCESS);
        }
        return $this->successMessageHolder;
    }

    protected function getWarningMessageHolder()
    {
        if (is_null($this->warningMessageHolder)) {
            $this->warningMessageHolder = ViewMessageHolder::getInstance(ViewMessageStatus::WARNING);
        }
        return $this->warningMessageHolder;
    }

    protected function getErrorMessageHolder()
    {
        if (is_null($this->errorMessageHolder)) {
            $this->errorMessageHolder = ViewMessageHolder::getInstance(ViewMessageStatus::DANGER);
        }
        return $this->errorMessageHolder;
    }

    /**
     * Build a success message.
     *
     * @param string $message
     * @return json
     */
    protected function addSuccessMessage($message)
    {
        $this->getSuccessMessageHolder()->addMessage($message);
    }

    /**
     * Build a warning message list.
     *
     * @param mixed $message
     * @return json
     */
    protected function addWarningMessage($message)
    {
        $this->getWarningMessageHolder()->addMessage($message);
    }

    /**
     * Build an error message list.
     *
     * @param mixed $message
     * @return json
     */
    protected function addErrorMessage($message)
    {
        $this->getErrorMessagesHolder()->addMessage($message);
    }

    protected function isTrue($boolean)
    {
        return filter_var($boolean, FILTER_VALIDATE_BOOLEAN) == true;
    }
}
