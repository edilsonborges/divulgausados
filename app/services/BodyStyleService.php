<?php

class BodyStyleService extends BaseService
{

    public function save($attributes)
    {
        return $this->persist($attributes,
            function ($params) {
                $bodyStyle = VehicleBodyStyle::create($params);
                $this->addSuccessMessage('Adicionado com sucesso!');
                return $bodyStyle;
            });
    }

    public function update($id, $attributes)
    {
        $this->persist($attributes,
            function ($params) use ($id) {
                $category = VehicleBodyStyle::find($id);
                $this->setAttributeIfExists($category, $params, 'name');
                $category->save();
                $this->addSuccessMessage('Atualizado com sucesso!');
            });
    }

    public function upload($id, $file)
    {
        $uploadedFile = $this->doUploadFile($id, '/img/body-style', $file);
        $make = VehicleBodyStyle::find($id);
        $make->image_path = $uploadedFile;
        $make->save();
    }

    public function delete($id)
    {
        $category = VehicleBodyStyle::find($id);
        if (!is_null($category)) {
            $category->delete();
            $this->addSuccessMessage('Excluído com sucesso!');
        } else {
            $this->addWarningMessage('Não pode ser excluído, porque não existe!');
        }
    }

    public function findOne($id)
    {
        return VehicleBodyStyle::find($id);
    }

    public function findAll()
    {
        if ($this->hasPagination()) {
            return VehicleBodyStyle::orderBy('name')->filter()->paginate($this->getPageSize());
        } else {
            return VehicleBodyStyle::orderBy('name')->filter()->get();
        }
    }

    protected function persist($attributes, $callback)
    {
        if (VehicleBodyStyle::validate($attributes)) {
            return $callback($attributes);
        } else {
            $this->addWarningMessage(VehicleBodyStyle::getValidationMessages());
        }
        return null;
    }

}
