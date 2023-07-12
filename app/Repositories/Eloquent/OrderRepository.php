<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Models\Product;
use App\Repositories\OrderRepositoryContract;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository extends EloquentRepository implements OrderRepositoryContract
{
    function __construct(Order $model)
    {
        parent::__contruct($model);
    }

    /**
     * Find order by primary key or fail
     * 
     * @param int $primary
     * @return Order
     * @throws ModelNotFoundException
     */
    public function findOrFail(int $primary): Order
    {
        return $this->model->with('products')->findOrFail($primary);
    }

    /**
     * Create a new order
     */
    public function create(array $products)
    {
        /** @var Order */
        $order = Order::create();

        $order->products()->attach(
            collect($products)->mapWithKeys(fn ($product) => [
                    $product['id'] => [
                        'quantity' => $product['quantity']
                    ]
                ]
            )
        );

        return $order->load('products');
    }

    /**
     * Get latest placeto pay by Order
     * 
     * @param Order $order 
     */
    public function getLatestPlacetoPay(Order $order)
    {
        return $order->placetoPays()->latest()->firstOrFail();
    }
}
