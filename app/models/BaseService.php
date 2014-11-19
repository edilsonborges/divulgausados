<?php

abstract class BaseService implements BaseServiceInterface
{

    const DEFAULT_PAGINATION_PAGE_SIZE = 10;

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
