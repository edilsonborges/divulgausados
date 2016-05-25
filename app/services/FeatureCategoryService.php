<?php

class FeatureCategoryService extends BaseService
{

    public function save($attributes)
    {
        return $this->persist($attributes, function ($validated) {
            $featureCategory = VehicleFeatureCategory::create($validated);
            $this->addSuccessMessage('Categoria de especificação adicionada com sucesso!');
            return $featureCategory;
        });
    }

    public function update($id, $attributes)
    {
        $this->persist($attributes, function ($validated) use ($id) {
            $featureCategory = VehicleFeatureCategory::find($id);
            $this->setAttributeIfExists($featureCategory, $validated, 'name');
            $featureCategory->save();
            $this->addSuccessMessage('Categoria de especificação atualizada com sucesso!');
        });
    }

    public function delete($id)
    {
        $featureCategory = VehicleFeatureCategory::find($id);
        if (!is_null($featureCategory)) {
            $featureCategory->delete();
            $this->addSuccessMessage('Categoria de especificação excluída com sucesso!');
        }
    }

    public function findOne($id)
    {
        return VehicleFeatureCategory::find($id);
    }

    public function findAll()
    {
        if ($this->hasPagination()) {
            return VehicleFeatureCategory::orderBy('name')->filter()->paginate($this->getPageSize());
        } else {
            return VehicleFeatureCategory::orderBy('name')->filter()->get();
        }
    }

    protected function persist($attributes, $callback)
    {
        if (VehicleFeatureCategory::validate($attributes)) {
            return $callback($attributes);
        } else {
            $this->addWarningMessage(VehicleFeatureCategory::getValidationMessages());
        }
        return null;
    }

}
