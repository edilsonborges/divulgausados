<?php

abstract class BaseService implements BaseServiceInterface
{

    protected function doUploadFile($id, $path, $file)
    {
        $destinationPath = public_path() . $path;
        $filename = $id . '_' . str_random(8) . '_' . date("Ymdhis") . '.' . $file->getClientOriginalExtension();
        error_log($filename);
        $file->move($destinationPath, $filename);
    }

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