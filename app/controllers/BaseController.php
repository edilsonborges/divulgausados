<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Build a success message.
	 *
	 * @param string $message
	 * @return json
	 */
	protected function getSuccessMessage($message)
	{
		$messageHolder = new ViewMessageHolder();
		$messageHolder->addMessage($message);
		$messageHolder->setStatus(ViewMessageStatus::SUCCESS);
		return Response::json($messageHolder);
	}

	/**
	 * Build a warning message list.
	 *
	 * @param mixed $message
	 * @return json
	 */
	protected function getWarningMessage($message)
	{
		$messageHolder = new ViewMessageHolder();
		if (is_array($message)) {
			$messageHolder->setMessageList($message);
		} else {
			$messageHolder->addMessage($message);
		}
		$messageHolder->setStatus(ViewMessageStatus::WARNING);
		return Response::json($messageHolder);
	}

	/**
	 * Build an error message list.
	 *
	 * @param mixed $message
	 * @return json
	 */
	protected function getErrorMessage($message)
	{
		$messageHolder = new ViewMessageHolder();
		if (is_array($message)) {
			$messageHolder->setMessageList($message);
		} else {
			$messageHolder->addMessage($message);
		}
		$messageHolder->setStatus(ViewMessageStatus::DANGER);
		return Response::json($messageHolder);
	}

	protected function isTrue($boolean)
	{
		return filter_var($boolean, FILTER_VALIDATE_BOOLEAN) == true;
	}

}
