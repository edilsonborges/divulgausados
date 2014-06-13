<?php

class VehicleBodyStyleController extends \BaseController {

	const DISPLAY_PAGE_SIZE = 9;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(VehicleBodyStyle::orderBy('name')->paginate(self::DISPLAY_PAGE_SIZE));
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
			return $this->getSuccessMessage('Adicionado com sucesso!');
		} else {
			return $this->getWarningMessage(VehicleBodyStyle::getValidationMessages());
		}
	}

	public function show($id)
	{
		return Response::json(VehicleBodyStyle::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$attributes = $this->retrieve();
		if (VehicleBodyStyle::validate($attributes)) {
			$category = VehicleBodyStyle::find($id);
			$category->name = $attributes['name'];
			$category->save();
			return $this->getSuccessMessage('Atualizado com sucesso!');
		} else {
			return $this->getWarningMessage(VehicleBodyStyle::getValidationMessages());
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		VehicleBodyStyle::find($id)->delete();
		return $this->getSuccessMessage('Excluído com sucesso!');
	}

	protected function retrieve()
	{
		return array(
			'name' => ucwords(Input::get('name'))
		);
	}

}
