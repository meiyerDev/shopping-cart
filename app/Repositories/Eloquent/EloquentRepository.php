<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class EloquentRepository implements EloquentRepositoryContract
{
    /** @var Model */
    protected $model;

    function __contruct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Return all paginateds
     * @param int $limit
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->latest()->get();
    }

    /**
     * Find data by primary key or fail
     * 
     * @param int $primary
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findOrFail(int $primary): Model
    {
        return $this->model->findOrFail($primary);
    }
}
