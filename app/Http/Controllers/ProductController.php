<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryContract;
use Inertia\Inertia;

class ProductController extends Controller
{
    /** @var ProductRepositoryContract */
    private $productRepository;

    function __construct(ProductRepositoryContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Return all products
     */
    public function index()
    {
        $products = $this->productRepository->getAll();

        return Inertia::render('Products/Index', [
            'products' => $products->map(fn ($product) => [
                'id' => $product->id,
                'sku' => $product->sku,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
            ])
        ]);
    }
}
