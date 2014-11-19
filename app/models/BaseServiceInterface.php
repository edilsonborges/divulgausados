<?php

interface BaseServiceInterface
{

	function save($attributes);

	function update($id, $attributes);

	function delete($id);

	function findOne($id);

	function findAll();

}
