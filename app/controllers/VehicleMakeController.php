<?php

class VehicleMakeController extends \BaseController
{
    private $makeService;

    public function __construct()
    {
        $this->makeService = new MakeService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return RestfulResponse
     */
    public function index()
    {
        return $this->jsonResponse($this->getService()->findAll());
    }

    protected function getService()
    {
        return $this->makeService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RestfulResponse
     */
    public function store()
    {
        $make = $this->getService()->save($this->retrieve());
        return $this->jsonResponse(!is_null($make) ? $make->id : null);
    }

    /**
     * Upload vehicle's make brand.
     *
     * @return RestfulResponse
     */
    public function upload()
    {
        if (Input::hasFile('logo')) {
            $this->getService()->upload(Input::get('make_id'), Input::file('logo'));
        }
        return $this->jsonResponse(null);
    }

    /**
     * Extract model attributes from request.
     */
    protected function retrieve()
    {
        return array(
            'name' => ucwords(Input::get('name')),
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return RestfulResponse
     */
    public function show($id)
    {
        return $this->jsonResponse($this->getService()->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return RestfulResponse
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
     * @return RestfulResponse
     */
    public function destroy($id)
    {
        $this->getService()->delete($id);
        return $this->jsonResponse(null);
    }
}