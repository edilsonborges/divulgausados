<?php

class VehicleFeatureCategoryController extends \BaseController
{
    private $featureCategoryService;

    public function __construct()
    {
        $this->featureCategoryService = new FeatureCategoryService();
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
            'name' => ucwords(Input::get('name')),
        );
    }

    /**
     * Get the service for specific controller
     * 
     * @return FeatureCategoryService
     */
    protected function getService()
    {
        return $this->featureCategoryService;
    }

}
