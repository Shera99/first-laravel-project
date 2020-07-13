<?php
namespace App\Repositories;

use App\Models\BlogCategory;

abstract class CoreRepository
{
    protected $model;

    public function __construct(){
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();

    /**
     * @return BlogCategory
     */
    protected function startConditions() {
        return clone $this->model;
    }
}
