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
        $bodyStyle = $this->getService()->save($this->retrieve());
        return $this->jsonResponse($bodyStyle);
    }

    public function upload()
    {
        if (Input::hasFile('file')) {
            $this->getService()->upload(Input::get('body_style_id'), Input::file('file'));
        }
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

    protected function getService()
    {
        return $this->bodyStyleService;
    }

}
