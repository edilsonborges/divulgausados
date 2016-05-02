<?php

abstract class BaseService implements BaseServiceInterface
{

    protected function doUploadFile($id, $path, $file)
    {
        $destinationPath = public_path() . $path . '/';
        $filename = $id . '_' . str_random(8) . '_' . date("Ymdhis") . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        return $filename;
    }

    protected function setAttributeIfExists($object, $params, $attribute) {
        if (array_key_exists($attribute, $params)) {
            $object->$attribute = $params[$attribute];
        }
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