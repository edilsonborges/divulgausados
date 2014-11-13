<?php

class VehicleBodyStyleController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->jsonResponse(VehicleBodyStyle::orderBy('name')->paginate(self::DISPLAY_PAGE_SIZE));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $attributes = $this->retrieve();
        if (VehicleBodyStyle::validate($attributes)) {
            VehicleBodyStyle::create($attributes)->save();
            $this->addSuccessMessage('Adicionado com sucesso!');
        } else {
            $this->addWarningMessage(VehicleBodyStyle::getValidationMessages());
        }
        return $this->jsonResponse(null);
    }

    public function show($id)
    {
        return $this->jsonResponse(VehicleBodyStyle::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update($id)
    {
        $attributes = $this->retrieve();
        if (VehicleBodyStyle::validate($attributes)) {
            $category = VehicleBodyStyle::find($id);
            $category->name = $attributes['name'];
            $category->save();
            $this->addSuccessMessage('Atualizado com sucesso!');
        } else {
            $this->addWarningMessage(VehicleBodyStyle::getValidationMessages());
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
        $category = VehicleBodyStyle::find($id);
        if (! is_null($category)) {
            $category->delete();
        }
        $this->addSuccessMessage('Excluído com sucesso!');
        return $this->jsonResponse(null);
    }

    protected function retrieve()
    {
        return array(
            'name' => ucwords(Input::get('name'))
        );
    }
}
