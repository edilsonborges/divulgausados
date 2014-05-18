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
	}

}
