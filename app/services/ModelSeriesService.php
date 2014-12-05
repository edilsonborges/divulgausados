<?php

class ModelSeriesService extends BaseService
{

    public function save($attributes)
    {
        $model = VehicleModel::find($attributes['model']['id']);
        $this->persist($this->getAttributes($attributes), function ($params) use ($model) {
            $modelSeries = new VehicleModelSeries($params);
            $model->modelSeries()->save($modelSeries);
            $this->addSuccessMessage("A versão foi adicionada ao modelo {$model->name} com sucesso!");
        });
    }

    public function update($id, $attributes)
    {
        $model = VehicleModel::find($attributes['model']['id']);
        $this->persist($this->getAttributes($attributes), function ($params) use ($model, $id) {
            $modelSeries = VehicleModelSeries::find($id);
            $modelSeries->name = $params['name'];
            $modelSeries->save();
            $this->addSuccessMessage("A versão do modelo {$model->name} foi alterada com sucesso!");
        });
    }

    protected function persist($attributes, $callback)
    {
        if (VehicleModelSeries::validate($attributes)) {
            $callback($attributes);
        } else {
            $this->addWarningMessage(VehicleModelSeries::getValidationMessages());
        }
    }

    public function delete($id)
    {
        $modelSeries = VehicleModelSeries::find($id);
        if (!is_null($modelSeries)) {
            $modelSeries->delete();
            $this->addSuccessMessage('Excluído com sucesso!');
        } else {
            $this->addWarningMessage('Não pôde ser excluído porque não existe!');
        }
    }

    public function findOne($id)
    {
        return VehicleModelSeries::find($id);
    }

    public function findAll()
    {
        if ($this->hasPagination()) {
            return VehicleModelSeries::orderBy('name')->filter()->paginate($this->getPageSize());
        } else {
            return VehicleModelSeries::orderBy('name')->filter()->one();
        }
    }

    protected function getAttributes($attributes)
    {
        return array('name' => $attributes['model_series']['name']);
    }

}
