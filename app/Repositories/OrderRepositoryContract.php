<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderRepositoryContract extends EloquentRepositoryContract
{
    /**
     * Create a new order
     * 
     * @param array $data
     * @param int $userId 
     */
    public function create(array $productIds);

    /**
     * Get latest placeto pay by Order
     * 
     * @param Order $order 
     */
    public function getLatestPlacetoPay(Order $order);
}
