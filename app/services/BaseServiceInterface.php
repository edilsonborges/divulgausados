<?php

interface BaseServiceInterface
{

    public function save($attributes);

    public function update($id, $attributes);

    public function delete($id);

    public function findOne($id);

    public function findAll();

}
