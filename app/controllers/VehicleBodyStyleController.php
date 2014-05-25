<?php

class VehicleBodyStyleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(VehicleBodyStyle::all());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$name = Input::get('name');
		$category = VehicleBodyStyle::create(array('name' => $name));
		$category->save();
		return Response::json(array("status" => "success", "message" => "Adicionado com sucesso!"));
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
		$category = VehicleBodyStyle::find($id);
		$category->name = Input::get('name');
		$category->save();
		return Response::json(array("status" => "success", "message" => "Atualizado com sucesso!"));
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
		return Response::json(array("status" => "success", "message" => "Excluído com sucesso!"));
	}

}
