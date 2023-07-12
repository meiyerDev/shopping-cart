<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\Order;
use App\Repositories\OrderRepositoryContract;
use App\Repositories\PlacetoPayRepositoryContract;
use Inertia\Inertia;

class OrderController extends Controller
{
    function __construct(
        private OrderRepositoryContract $orderRepository,
        private PlacetoPayRepositoryContract $placetoPayRepository
    )
    {
        $this->orderRepository = $orderRepository;
    }

    public function store(CreateOrderRequest $request)
    {
        /** @var Order */
        $order = $this->orderRepository->create(
            $request->get('products')
        );

        $data = $this->placetoPayRepository->createRequestPaymentByOrder($order);

        if (isset($data['process_url'])) {
            return response()->json([
                'process_url' => $data['process_url'],
            ]);
        }

        return response()->json([
            'error' => 'No se pudo crear la solicitud de pago, por favor espere y vuelva a intentarlo',
        ], 500);
    }

    public function show(int $order)
    {
        $order = $this->orderRepository->findOrFail($order);

        return Inertia::render('Order/Show', [
            'order' => $order,
            'placetoPay' => $this->orderRepository->getLatestPlacetoPay($order),
        ]);
    }
}
