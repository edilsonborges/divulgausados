<?php

class MessageControlCenter
{
    private static $instance = null;
    private $errorMessageHolder;
    private $warningMessageHolder;
    private $successMessageHolder;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new MessageControlCenter();
        }
        return self::$instance;
    }

    /**
     * Build a success message.
     *
     * @param mixed $message
     */
    public function addSuccessMessage($message)
    {
        $this->getSuccessMessageHolder()->addMessage($message);
    }

    protected function getSuccessMessageHolder()
    {
        if (is_null($this->successMessageHolder)) {
            $this->successMessageHolder = ViewMessageHolder::getInstance(ViewMessageStatus::SUCCESS);
        }
        return $this->successMessageHolder;
    }

    public function getSuccessMessages()
    {
        return $this->getSuccessMessageHolder()->getMessageList();
    }

    /**
     * Build a warning message list.
     *
     * @param mixed $message
     */
    public function addWarningMessage($message)
    {
        $this->getWarningMessageHolder()->addMessage($message);
    }

    protected function getWarningMessageHolder()
    {
        if (is_null($this->warningMessageHolder)) {
            $this->warningMessageHolder = ViewMessageHolder::getInstance(ViewMessageStatus::WARNING);
        }
        return $this->warningMessageHolder;
    }

    public function getWarningMessages()
    {
        return $this->getWarningMessageHolder()->getMessageList();
    }

    /**
     * Build an error message list.
     *
     * @param mixed $message
     */
    public function addErrorMessage($message)
    {
        $this->getErrorMessagesHolder()->addMessage($message);
    }

    public function getErrorMessages()
    {
        return $this->getErrorMessageHolder()->getMessageList();
    }

    protected function getErrorMessageHolder()
    {
        if (is_null($this->errorMessageHolder)) {
            $this->errorMessageHolder = ViewMessageHolder::getInstance(ViewMessageStatus::DANGER);
        }
        return $this->errorMessageHolder;
    }

    public function clear()
    {
        $this->errorMessageHolder = null;
        $this->warningMessageHolder = null;
        $this->successMessageHolder = null;
    }
}