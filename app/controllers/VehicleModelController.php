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

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->jsonResponse($this->getService()->findAll());
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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return $this->jsonResponse($this->getService()->findOne($id));
    }

    protected function retrieve()
    {
        return array(
            'model' => array('name' => Input::get('name')),
            'make' => Input::get('make'),
        );
    }

}
