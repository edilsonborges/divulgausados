<?php

class VehicleModelSeriesController extends BaseController
{
    private $modelSeriesService;

    public function __construct()
    {
        $this->modelSeriesService = new ModelSeriesService();
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
        $this->getService()->save($this->retrieve());
        return $this->jsonResponse(null);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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
        return array(
            'model_series' => array('name' => Input::get('name')),
            'model' => Input::get('model'),
        );
    }

    protected function getService()
    {
        return $this->modelSeriesService;
    }

}
