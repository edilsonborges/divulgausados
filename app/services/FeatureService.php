<?php

class FeatureService extends BaseService
{

    public function save($attributes)
    {
        $category = VehicleFeatureCategory::find($attributes['category']['id']);
        return $this->persist($attributes['feature'], function ($validated) use ($category) {
            $feature = new VehicleFeature($validated);
            $category->features()->save($feature);
            $this->addSuccessMessage("Especificação adicionada à categoria {$category->name} com sucesso!");
            return $feature;
        });
    }

    public function update($id, $attributes)
    {
        $this->persist($attributes['feature'], function ($validated) use ($id) {
            $feature = VehicleFeature::find($id);
            $this->setAttributeIfExists($feature, $validated, 'name');
            $this->setAttributeIfExists($feature, $validated, 'type');
            $feature->save();
            $this->addSuccessMessage('Especificação atualizada com sucesso!');
        });
    }

    public function delete($id)
    {
        $feature = VehicleFeature::find($id);
        if (!is_null($feature)) {
            $feature->delete();
            $this->addSuccessMessage('Especificação excluída com sucesso!');
        }
    }

    public function findOne($id)
    {
        return VehicleFeature::find($id);
    }

    public function findAll()
    {
        if ($this->hasPagination()) {
            return VehicleFeature::orderBy('name')->filter()->paginate($this->getPageSize());
        } else {
            return VehicleFeature::orderBy('name')->filter()->get();
        }
    }

    protected function persist($attributes, $callback)
    {
        if (VehicleFeature::validate($attributes)) {
            return $callback($attributes);
        } else {
            $this->addWarningMessage(VehicleFeature::getValidationMessages());
        }
        return null;
    }

}
