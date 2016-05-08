<?php

class MakeService extends BaseService
{

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
        $this->persist($attributes, function ($validated) use ($id) {
            $make = VehicleMake::find($id);
            $this->setAttributeIfExists($make, $validated, 'name');
            $this->setAttributeIfExists($make, $validated, 'brand_image_path');
            $make->save();
            $this->addSuccessMessage('Atualizado com sucesso!');
        });
    }

    public function upload($id, $file)
    {
        $uploadedFile = $this->doUploadFile($id, '/img/make', $file);
        $make = VehicleMake::find($id);
        $make->brand_image_path = $uploadedFile;
        $make->save();
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

    protected function persist($attributes, $callback)
    {
        if (VehicleMake::validate($attributes)) {
            return $callback($attributes);
        } else {
            $this->addWarningMessage(VehicleMake::getValidationMessages());
        }
        return null;
    }

}
