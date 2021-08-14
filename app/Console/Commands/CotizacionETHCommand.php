<?php

namespace App\Console\Commands;

use App\Facades\CotizacionCriptoServiceFacade;
use Illuminate\Console\Command;
use NunoMaduro\Collision\Exceptions\ShouldNotHappen;
use Revolution\Google\Sheets\Sheets;

class CotizacionETHCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cotizacion:ETH';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Obtiene la cotizacion del ETH';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cotizacion = CotizacionCriptoServiceFacade::getCotizacion("Etherum");
        \Log::info($cotizacion);
        $client = new \Google_Client();
        $client->setApplicationName(config('google.APPLICATION_NAME'));
        $client->setClientId(config('google.CLIENT_ID'));
        $client->setScopes([config('google.SPREADSHEETS_SCOPE')]);
        $client->setAuthConfig(config('google.KEY_FILE'));
        $client->useApplicationDefaultCredentials();

        if ($client->isAccessTokenExpired())
            $client->refreshTokenWithAssertion();

        $service_token = $client->getAccessToken();

        $service = new \Google_Service_Sheets($client);


        $sheets = new Sheets();
        $sheets->setService($service);


//        $rows = $sheets->spreadsheet('1l6AsUXV-6yqQ3EM-qLdXBCRXPgfJtA5PL32mOx48dWI')->sheet('ETH')->get(); //spreadsheetID is from URL of your google spreadsheet, sheet name is sheet inside it
//        $sheets->spreadsheet('1l6AsUXV-6yqQ3EM-qLdXBCRXPgfJtA5PL32mOx48dWI')->sheet('ETH')->append([["hola","chau","lala","asd","asdasd","kfkf"]]);
//        $header = $rows->pull(0);

//        $currencys = $sheets->collection($header, $rows);
//        $currencysArray = $currencys->toArray();
//
//        \Log::info($currencysArray);

        $sheets->spreadsheet('1l6AsUXV-6yqQ3EM-qLdXBCRXPgfJtA5PL32mOx48dWI')
            ->sheet('ETH')
            ->append([[
                $cotizacion['fechaHora']->format('Y-m-d H:i:s'),
                $cotizacion['stats']["ETH"]['expectedReward24H'],
                $cotizacion['stats']["ETH"]['meanExpectedReward24H'],
                $cotizacion['stats']["ETH"]['threshold'],
                $cotizacion['stats']["ETH"]['exchangeRates']['USD'],
                $cotizacion['stats']["ETH"]['hashrate'],
                $cotizacion['stats']["ETH"]['blocksFound']
            ]]);
    }
}
