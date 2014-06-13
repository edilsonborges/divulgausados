<?php

class VehicleMakeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$resultSet = array();
		if ($this->isTrue(Input::get('showDestroyed'))) {
			$resultSet = VehicleMake::onlyTrashed()->orderBy('name')->get();
		} else {
			$resultSet = VehicleMake::orderBy('name')->get();
		}
		return Response::json($resultSet);
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
			return $this->getSuccessMessage('Fabricante adicionado com sucesso!');
		} else {
			return $this->getWarningMessage(VehicleMake::getValidationMessages());
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	public function edit($id)
	{
		VehicleMake::withTrashed()->where('id', $id)->restore();
		return $this->getSuccessMessage('Fabricante restaurado com sucesso!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		VehicleMake::find($id)->delete();
		return $this->getSuccessMessage('Fabricante excluído com sucesso!');
	}

	protected function retrieve()
	{
		return array(
			'name' => ucwords(Input::get('name'))
		);
	}

}
