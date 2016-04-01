<?php

class MakeService extends BaseService
{

    public function upload($id, $file)
    {
        $this->doUploadFile($id, '/img/make/', $file);
    }

    public function save($attributes)
    {
        return $this->persist($attributes, function ($params) {
            $make = VehicleMake::create($params);
            $this->addSuccessMessage('Fabricante adicionado com sucesso!');
            return $make;
        });
    }

    public function update($id, $attributes)
    {
        $this->persist($attributes, function ($params) use ($id) {
            $make = VehicleMake::find($id);
            $make->name = $params['name'];
            $make->save();
            $this->addSuccessMessage('Atualizado com sucesso!');
        });
    }

    protected function persist($attributes, $callback)
    {
        if (VehicleMake::validate($attributes)) {
            return $callback($attributes);
        } else {
            $this->addWarningMessage(VehicleMake::getValidationMessages());
        }
        return null;
    }

    public function delete($id)
    {
        $make = VehicleMake::find($id);
        if (!is_null($make)) {
            $make->delete();
            $this->addSuccessMessage('Fabricante excluído com sucesso!');
        }
    }

    public function findOne($id)
    {
        return VehicleMake::find($id);
    }

    public function findAll()
    {
        if ($this->hasPagination()) {
            return VehicleMake::orderBy('name')->filter()->paginate($this->getPageSize());
        } else {
            return VehicleMake::orderBy('name')->filter()->get();
        }
    }
}