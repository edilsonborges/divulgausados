<?php

class VehicleController extends \BaseController
{

    private $vehicleService;

    public function __construct()
    {
        $this->vehicleService = new vehicleService();
    }

    public function getService()
    {
        return $this->vehicleService;
    }

    public function index()
    {
        return $this->jsonResponse($this->getService()->findAll());
    }

    public function store()
    {
        $vehicle = $this->getService()->save($this->retrieve());
        return $this->jsonResponse(!is_null($vehicle) ? $vehicle->id : null);
    }

    public function show($id)
    {
        return $this->jsonResponse($this->getService()->findOne($id));
    }

    public function update($id)
    {
        $this->getService()->update($id, $this->retrieve());
        return $this->jsonResponse(null);
    }

    public function upload()
    {
        if (Input::hasFile('file')) {
            $this->getService()->upload(Input::get('vehicle_id'), Input::file('file'));
        }
        return $this->jsonResponse(null);
    }

    protected function retrieve()
    {
        return array(
            'vehiclebodystyle_id' => Input::get('vehiclebodystyle_id'),
            'vehiclemake_id' => Input::get('vehiclemake_id'),
            'vehiclemodelseries_id' => Input::get('vehiclemodelseries_id'),
            'kilometres' => Input::get('kilometres'),
            'price' => Input::get('price'),
            'color' => Input::get('color'),
        );
    }

}
