<?php

class VehicleModelSeriesController extends BaseController
{

	private $modelSeriesService;

	public function __construct()
	{
		$this->modelSeriesService = new ModelSeriesService();	
	}

	protected function getService()
	{
		return $this->modelSeriesService;
	}

	public function index()
	{
		return $this->jsonResponse($this->getService()->findAll());
	}

}
