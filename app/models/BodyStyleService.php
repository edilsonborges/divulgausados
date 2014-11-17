<?php

class BodyStyleService extends BaseService
{

    public function save($attributes)
    {
        $this->persist($attributes, function ($params) {
            VehicleBodyStyle::create($params)->save();
            $this->addSuccessMessage('Adicionado com sucesso!');
        });
    }

    public function update($id, $attributes)
    {
        $this->persist($attributes, function ($params) use ($id) {
            $category = VehicleBodyStyle::find($id);
            $category->name = $params['name'];
            $category->save();
            $this->addSuccessMessage('Atualizado com sucesso!');
        });
    }

    protected function persist($attributes, $callback)
    {
        if (VehicleBodyStyle::validate($attributes)) {
            $callback($attributes);
        } else {
            $this->addWarningMessage(VehicleBodyStyle::getValidationMessages());
        }
    }

    public function delete($id)
    {
        $category = VehicleBodyStyle::find($id);
        if (!is_null($category)) {
            $category->delete();
        }
        $this->addSuccessMessage('Excluído com sucesso!');
    }

    public function findOne($id)
    {
        return VehicleBodyStyle::find($id);
    }

    public function findAll($pageSize = 10)
    {
        return VehicleBodyStyle::orderBy('name')->filter()->paginate($pageSize);
    }

}
