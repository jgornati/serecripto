<?php

namespace App\Services;

use App\Models\Cripto;

class CotizacionCriptoService
{
    public $tries = 0;
    public $maxTries = 5;

    function getCotizacion($nomMoneda)
    {
        $this->tries = 0;
        $cotizacion = 0;
        switch ($nomMoneda) {
            case Cripto::$ETH:
                $cotizacion = $this->getETH();
                break;
        }
        return $cotizacion;
    }

    function getETH()
    {

        try {

            return $res;

        } catch (\Exception $e) {
            \Log::info('Esperando moneda');
            if ($this->tries < $this->maxTries) {
                $this->tries++;
                sleep(30);
                $this->getETH();
            } else return 0;
        }
    }
}
