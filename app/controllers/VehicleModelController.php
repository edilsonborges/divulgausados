<?php

class VehicleModelController extends BaseController
{

	private $modelService;

	public function __construct()
	{
		$this->modelService = new ModelService();	
	}

	protected function getService()
	{
		return $this->modelService;
	}

	public function index()
	{
		return $this->jsonResponse($this->getService()->findAll());
	}

	public function store()
	{
		$this->getService()->save($this->retrieve());
		return $this->jsonResponse(null);
	}

}
