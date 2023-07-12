<?php

namespace App\Providers;

use Dnetix\Redirection\PlacetoPay;
use Illuminate\Support\ServiceProvider;

class PlacetoPayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PlacetoPay::class,
            function (\Illuminate\Contracts\Foundation\Application $app) {
                $config = config('placetoPay.auth');
                return new PlacetoPay($config);
            }
        );
    }
}
