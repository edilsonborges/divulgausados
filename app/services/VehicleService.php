<?php

class VehicleService extends BaseService
{

    public function upload($id, $file)
    {
        $destinationPath = public_path() . '/img/vehicle/';
        $filename = $id . '_' . str_random(8) . '_' . date("Ymdhis") . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
    }

    public function save($attributes)
    {
        $this->persist($attributes, function ($params) {
            $vehicle = Vehicle::create($params);
            $vehicle->save();
            $this->addSuccessMessage('Adicionado com sucesso!');
            return $vehicle;
        });
    }

    public function update($id, $attributes)
    {
        $this->persist($attributes, function ($params) use ($id) {
            $category = Vehicle::find($id);
            $category->name = $params['name'];
            $category->save();
            $this->addSuccessMessage('Atualizado com sucesso!');
        });
    }

    protected function persist($attributes, $callback)
    {
        if (Vehicle::validate($attributes)) {
            return $callback($attributes);
        } else {
            $this->addWarningMessage(Vehicle::getValidationMessages());
        }
    }

    public function delete($id)
    {
        $category = Vehicle::find($id);
        if (!is_null($category)) {
            $category->delete();
            $this->addSuccessMessage('Excluído com sucesso!');
        } else {
            $this->addWarningMessage('Não pode ser excluído, porque não existe!');
        }
    }

    public function findOne($id)
    {
        return Vehicle::find($id);
    }

    public function findAll()
    {
        if ($this->hasPagination()) {
            return Vehicle::orderBy('name')->filter()->paginate($this->getPageSize());
        } else {
            return Vehicle::orderBy('name')->filter()->get();
        }
    }

}
