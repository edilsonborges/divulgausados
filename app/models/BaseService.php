<?php

class BaseService
{

    protected function addSuccessMessage($message)
    {
        MessageControlCenter::getInstance()->addSuccessMessage($message);
    }

    protected function addWarningMessage($message)
    {
        MessageControlCenter::getInstance()->addWarningMessage($message);
    }

    protected function addErrorMessage($message)
    {
        MessageControlCenter::getInstance()->addErrorMessage($message);
    }

}
