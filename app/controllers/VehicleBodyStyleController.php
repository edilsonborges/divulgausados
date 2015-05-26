<?php

class VehicleBodyStyleController extends \BaseController
{
    private $bodyStyleService;

    public function __construct()
    {
        $this->bodyStyleService = new BodyStyleService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->jsonResponse($this->getService()->findAll());
    }

    protected function getService()
    {
        return $this->bodyStyleService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->getService()->save($this->retrieve());
        return $this->jsonResponse(null);
    }

    protected function retrieve()
    {
        return array(
            'name' => ucwords(Input::get('name')),
        );
    }

    public function show($id)
    {
        return $this->jsonResponse($this->getService()->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
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
     * @return Response
     */
    public function destroy($id)
    {
        $this->getService()->delete($id);
        return $this->jsonResponse(null);
    }
}