<?php

namespace App\Providers;

use App\Services\CotizacionCriptoService;
use Illuminate\Support\ServiceProvider;

class CotizacionCriptoSeriviceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cotizacion-cripto-service-provider', function () {
            return new CotizacionCriptoService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
