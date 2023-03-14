<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{
    public function list(Model $model)
    {
        return $model::orderBy('id', 'desc')->get();
    }

    abstract public function save(array $data);

    public function destroy(Model $model)
    {
        try {
            $model->delete();
        } catch (\Exception $e) {
            return $e;
        }

        return true;
    }
}