<?php

class VehicleFeatureValueController extends BaseController
{
    protected $featureValueService;
    
    public function __construct()
    {
        $this->featureValueService = new FeatureValueService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->jsonResponse($this->getService()->findAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->getService()->saveAll($this->retrieve());
        return $this->jsonResponse(null);
    }

    public function show($id)
    {
        return $this->jsonResponse($this->getService()->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->getService()->update($id, $this->retrieve());
        return $this->jsonResponse(null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->getService()->delete($id);
        return $this->jsonResponse(null);
    }

    protected function retrieve()
    {
        $resultSet = [];
        $featureList = Input::get('featureList');
        foreach ($featureList as $feature) {
            array_push($resultSet, [
                'value' => $feature['value'],
                'vehicle_id' => $feature['vehicle_id'],
                'vehiclefeature_id' => $feature['vehiclefeature_id'],
            ]);
        }
        return $resultSet;
    }

    protected function retrieveAll()
    {

    }

    protected function getService()
    {
        return $this->featureValueService;
    }
    
}
