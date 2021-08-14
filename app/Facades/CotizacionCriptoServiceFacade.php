<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class CotizacionCriptoServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cotizacion-cripto-service-provider';
    }
}
