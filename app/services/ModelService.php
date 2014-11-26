<?php

class ModelService extends BaseService
{

    public function save($attributes)
    {
        $make = VehicleMake::find($attributes['make']['id']);
        $this->persist(array('name' => $attributes['model']['name']), function ($params) use ($make) {
            $model = new VehicleModel($params);
            $make->models()->save($model);
            $this->addSuccessMessage("Modelo adicionado ao fabricante {$make->name} com sucesso!");
        });
    }

    public function update($id, $attributes)
    {

    }

    protected function persist($attributes, $callback)
    {
        if (VehicleMake::validate($attributes)) {
            $callback($attributes);
        } else {
            $this->addWarningMessage(VehicleMake::getValidationMessages());
        }
    }

    public function delete($id)
    {

    }

    public function findOne($id)
    {
        return VehicleModel::find($id);
    }

    public function findAll()
    {
        if ($this->hasPagination()) {
            return VehicleModel::orderBy('name')->filter()->paginate($this->getPageSize());
        } else {
            return VehicleModel::orderBy('name')->filter()->get();
        }
    }

}
