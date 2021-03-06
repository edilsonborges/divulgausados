<?php

class ModelService extends BaseService
{

    public function save($attributes)
    {
        $make = VehicleMake::find($attributes['make']['id']);
        $this->persist($this->getAttributes($attributes),
            function ($params) use ($make) {
                $model = new VehicleModel($params);
                $make->models()->save($model);
                $this->addSuccessMessage("O modelo foi adicionado ao fabricante {$make->name} com sucesso!");
            });
    }

    public function update($id, $attributes)
    {
        $make = VehicleMake::find($attributes['make']['id']);
        $this->persist($this->getAttributes($attributes),
            function ($params) use ($make, $id) {
                $model = VehicleModel::find($id);
                $this->setAttributeIfExists($model, $params, 'name');
                $this->setAttributeIfExists($model, $params, 'vehiclebodystyle_id');
                $model->save();
                $this->addSuccessMessage("O modelo do fabricante {$make->name} foi alterado com sucesso!");
            });
    }

    public function delete($id)
    {
        $model = VehicleModel::find($id);
        if (!is_null($model)) {
            $model->delete();
            $this->addSuccessMessage('Excluído com sucesso!');
        } else {
            $this->addWarningMessage('Não pôde ser excluído porque não existe!');
        }
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

    protected function persist($attributes, $callback)
    {
        if (VehicleModel::validate($attributes)) {
            $callback($attributes);
        } else {
            $this->addWarningMessage(VehicleModel::getValidationMessages());
        }
    }

    protected function getAttributes($attributes)
    {
        return $attributes['model'];
    }

}
