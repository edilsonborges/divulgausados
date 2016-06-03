<?php

class FeatureValueService extends BaseService
{

    public function save($attributes)
    {
        return $this->persist($attributes, function ($validated) {
            $featureValue = VehicleFeatureValue::create($validated);
            return $featureValue;
        });
    }

    public function saveAll(array $collection)
    {
        foreach ($collection as $featureValue) {
            $this->save($featureValue);
        }
        $this->addSuccessMessage('Especificação do veículo adicionada com sucesso!');
    }

    public function update($id, $attributes)
    {
        $this->persist($attributes, function ($validated) use($id) {
            $featureValue = VehicleFeatureValue::find($id);
            $this->setAttributeIfExists($featureValue, $validated, 'value');
            $featureValue->save();
            $this->addSuccessMessage('Especificação do veículo atualizada com sucesso!');
        });
    }

    public function delete($id)
    {
        $featureValue = VehicleFeatureCategory::find($id);
        if (!is_null($featureValue)) {
            $featureValue->delete();
        }
    }
    
    public function deleteAll(array $ids)
    {
        foreach ($ids as $id) {
            $this->delete($id);
        }
        $this->addSuccessMessage('Especificação do veículo excluída com sucesso!');
    }

    public function findOne($id)
    {
        return VehicleFeatureValue::with('vehicle', 'feature')->find($id);
    }

    public function findAll()
    {
        $query = VehicleFeatureValue::orderBy('vehiclefeature_id')->filter()->with('vehicle', 'feature', 'feature.featureCategory');
        if ($this->hasPagination()) {
            return $query->paginate($this->getPageSize());
        } else {
            return $query->get();
        }
    }

    protected function persist($attributes, $callback)
    {
        if (VehicleFeatureValue::validate($attributes)) {
            return $callback($attributes);
        } else {
            $this->addWarningMessage(VehicleFeatureValue::getValidationMessages());
        }
        return null;
    }

}
