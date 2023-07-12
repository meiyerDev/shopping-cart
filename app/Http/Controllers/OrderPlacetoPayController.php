<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repositories\OrderRepositoryContract;
use App\Repositories\PlacetoPayRepositoryContract;
use Illuminate\Support\Facades\Auth;

class OrderPlacetoPayController extends Controller
{
    /** @var OrderRepositoryContract */
    private $orderRepository;

    /** @var PlacetoPayRepositoryContract */
    private $placetoPayRepository;

    function __construct(
        OrderRepositoryContract $orderRepository,
        PlacetoPayRepositoryContract $placetoPayRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->placetoPayRepository = $placetoPayRepository;
    }

    /**
     * Receive user from placetoPay flow successfull
     */
    public function receivedSuccessful(
        int $orderId,
        string $referenceId
    ) {
        /** @var Order */
        $order = $this->orderRepository->findOrFail($orderId);

        $route = $this->placetoPayRepository->updateOrderByPlacetoPay($order, $referenceId);

        return redirect()->to($route);
    }

    /**
     * Receive user from placetoPay flow canceled
     */
    public function receivedcanceled(
        int $orderId,
        string $referenceId
    ) {
        /** @var Order */
        $order = $this->orderRepository->findOrFail($orderId);

        $route = $this->placetoPayRepository->cancelOrderByPlacetoPay($order, $referenceId);

        return redirect()->to($route);
    }
}
