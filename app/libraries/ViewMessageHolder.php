<?php
use Illuminate\Support\Contracts\ArrayableInterface;

/**
 * Utility class for message handling, used to store system validation, success or informational messages.
 */
class ViewMessageHolder implements ArrayableInterface
{

    private $messageList;

    /**
     * Sign the message status issued, it may only be one of ViewMessageStatus values.
     */
    private $status;

    public function __constructor(array $messageList, $status)
    {
        $this->messageList = $messageList;
        $this->status = $status;
    }

    public static function getInstance($status)
    {
        $viewMessageHolder = new ViewMessageHolder();
        $viewMessageHolder->setStatus($status);
        return $viewMessageHolder;
    }

    public function getMessage()
    {
        return array_pop($this->messageList);
    }

    public function getMessageList()
    {
        return $this->messageList;
    }

    public function setMessageList(array $messageList)
    {
        $this->messageList = $messageList;
    }

    public function addMessage($message)
    {
        if (is_null($this->messageList)) {
            $this->messageList = array();
        }
        if (is_array($message)) {
            $this->messageList = array_merge($this->messageList, $message);
        } else {
            array_push($this->messageList, $message);
        }
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function isErrorMessage()
    {
        return (strcmp($this->status, ViewMessageStatus::WARNING) == 0) || (strcmp($this->status, ViewMessageStatus::DANGER) == 0);
    }

    public function toArray()
    {
        return array(
            'messageList' => $this->messageList,
            'status' => $this->status,
            'isError' => $this->isErrorMessage()
        );
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
