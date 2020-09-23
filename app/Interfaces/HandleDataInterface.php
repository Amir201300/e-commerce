<?php

namespace App\Interfaces;

interface HandleDataInterface {
    /**
     * @param $model
     * @param $resource
     * @param $request
     * @return mixed
     */
    public function getAllData($model,$request,$resource);

    /**
     * @param $model
     * @param $model_id
     * @param $request
     * @param $resorce
     * @return mixed
     */
    public function getSingleDsta($model,$model_id,$request,$resorce);

    /**
     * @param $model
     * @param $model_id
     * @param $request
     * @return mixed
     */
    public function deleteData($model,$model_id,$request,$folderName=null);

}