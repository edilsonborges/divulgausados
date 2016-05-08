<?php

class FeatureCategoryService extends BaseService
{

    public function save($attributes)
    {
        // TODO: Implement save() method.
    }

    public function update($id, $attributes)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function findOne($id)
    {
        // TODO: Implement findOne() method.
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
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
