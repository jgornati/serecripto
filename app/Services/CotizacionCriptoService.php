<?php

namespace App\Services;

use App\Models\Cripto;
use GuzzleHttp\Client;

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
            $this->client = new Client([
                // Base URI is used with relative requests
                'base_uri' => "https://hiveon.net/",
                // You can set any number of default request options.
                'timeout' => 200.0,
            ]);

            $res = $this->client->request('GET', "api/v1/stats/pool");
            $response = json_decode($res->getBody(), true);

            $fechaHora = (new \DateTime())->setTimezone(new \DateTimeZone("America/Argentina/Buenos_Aires"));
            $response["fechaHora"] = $fechaHora;

            return $response;

        } catch (\Exception $e) {
            \Log::info('Hubo un error 😩esperando moneda');
            if ($this->tries < $this->maxTries) {
                $this->tries++;
                sleep(30);
                $this->getETH();
            } else
                return 0;
        }
    }
}
