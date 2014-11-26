<?php

abstract class BaseModel extends Eloquent
{

    /**
     * Model validation messages, only filled if error occurs.
     */
    protected static $validationMessages = null;

    public static function getValidationMessages()
    {
        return self::$validationMessages;
    }

    /**
     * Validate form input.
     *
     * @param array $input
     * @return boolean
     */
    public static function validate(array $input = null)
    {
        if (is_null($input)) {
            $input = Input::all();
        }

        $validator = Validator::make($input, static::$rules);
        if ($validator->passes()) {
            return true;
        } else {
            Input::flash();
            self::$validationMessages = $validator->errors()->all();
            return false;
        }
    }

    protected function equalToFilter($query, $field, $filterBy)
    {
        $this->createGenericFilter($query, $field, $filterBy, '=');
    }

    protected function greaterThanFilter($query, $field, $filterBy)
    {
        $this->createGenericFilter($query, $field, $filterBy, '>');
    }

    protected function lessThanFilter($query, $field, $filterBy)
    {
        $this->createGenericFilter($query, $field, $filterBy, '<');
    }

    private function createGenericFilter($query, $field, $filterBy, $operation)
    {
        if (Input::has($filterBy)) {
            $query->where($field, $operation, Input::get($filterBy));
        }
    }

    protected function likeFilter($query, $field, $filterBy)
    {
        if (Input::has($filterBy)) {
            $filteredValue = '%' . Input::get($filterBy) . '%';
            $query->whereRaw('lower(' . $field . ') like lower(?)', array($filteredValue));
        }
    }

}
