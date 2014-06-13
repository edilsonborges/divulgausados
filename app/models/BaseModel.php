<?php

class BaseModel extends Eloquent {

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

}
