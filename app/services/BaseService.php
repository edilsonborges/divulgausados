<?php

abstract class BaseService implements BaseServiceInterface
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

    protected function hasPagination()
    {
        return Input::has('page') && Input::has('page_size');
    }

    protected function getPageSize()
    {
        return Input::get('page_size');
    }

}
