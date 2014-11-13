<?php

class VehicleMakeController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $resultSet = array();
        if ($this->isTrue(Input::get('showDestroyed'))) {
            $resultSet = VehicleMake::onlyTrashed()->orderBy('name')->paginate(self::DISPLAY_PAGE_SIZE);
        } else {
            $resultSet = VehicleMake::orderBy('name')->paginate(self::DISPLAY_PAGE_SIZE);
        }
        return $this->jsonResponse($resultSet);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $attributes = $this->retrieve();
        if (VehicleMake::validate($attributes)) {
            VehicleMake::create($attributes)->save();
            $this->addSuccessMessage('Fabricante adicionado com sucesso!');
        } else {
            $this->addWarningMessage(VehicleMake::getValidationMessages());
        }
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
        return $this->jsonResponse(null);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update($id)
    {
        return $this->jsonResponse(null);
    }

    public function activate($vehicleMakeId)
    {
        $make = VehicleMake::withTrashed()->where('id', $id);
        if (! is_null($make)) {
            $make->restore();
            $this->addSuccessMessage('Fabricante restaurado com sucesso!');
        }
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
        $make = VehicleMake::find($id);
        if (! is_null($make)) {
            $make->delete();
            $this->addSuccessMessage('Fabricante excluído com sucesso!');
        }
        return $this->jsonResponse(null);
    }

    protected function retrieve()
    {
        return array(
            'name' => ucwords(Input::get('name'))
        );
    }
}
