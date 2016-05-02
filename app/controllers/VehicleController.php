<?php

class VehicleController extends \BaseController
{
    private $vehicleService;

    public function __construct()
    {
        $this->vehicleService = new VehicleService();
    }

    public function index()
    {
        $vehicles = $this->getService()->findAll();
        foreach ($vehicles as $vehicle) {
            $vehicle->images = $this->fetchImages($vehicle);
        }
        return $this->jsonResponse($vehicles);
    }

    private function fetchImages($vehicle) {
        $foundImages = [];
        $images = glob(public_path() . "/img/vehicle/{$vehicle->id}_*");
        foreach ($images as $image) {
            $foundImages[] = str_replace(public_path(), '', $image);
        }
        return $foundImages;
    }

    public function getService()
    {
        return $this->vehicleService;
    }

    public function store()
    {
        $vehicle = $this->getService()->save($this->retrieve());
        return $this->jsonResponse(!is_null($vehicle) ? $vehicle->id : null);
    }

    protected function retrieve()
    {
        return array(
            'user_id' => 1,
            'vehiclebodystyle_id' => $this->extractId(Input::get('vehiclebodystyle_id')),
            'vehiclemake_id' => $this->extractId(Input::get('vehiclemake_id')),
            'vehiclemodelseries_id' => $this->extractId(Input::get('vehiclemodelseries_id')),
            'kilometres' => Input::get('kilometres'),
            'price' => Input::get('price'),
            'colour' => Input::get('colour'),
        );
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
}