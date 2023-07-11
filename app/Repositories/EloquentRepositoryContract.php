<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

interface EloquentRepositoryContract
{
    /**
     * Return all paginateds
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Find data by primary key or fail
     * 
     * @param int $primary
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findOrFail(int $primary): Model;
}
