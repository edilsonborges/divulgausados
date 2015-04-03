<?php

class VehicleDataUploadHelper
{
    private $vehicle;

    private $uploadImages = array();

    public function getVehicle()
    {
        return $this->vehicle;
    }

    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;
    }

    public function uploadAll()
    {
        $destinationPath = public_path() . '/img/vehicle/';
        $uploadSuccess = false;
        foreach ($this->uploadImages : $uploadedImage) {
            $filename = str_random(6) . '_' . md5($uploadedImage->getClientOriginalName());
            $uploadSuccess = $uploadedImage->move($destinationPath, $filename);
        }
        return $uploadSuccess;
    }

    public function addUploadedImage($uploadedImage)
    {
        array_push($this->uploadImages, $uploadedImage);
    }

    public function removeUploadedImage()
    {
        array_pop($this->uploadImages);
    }

}
