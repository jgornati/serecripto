<?php

namespace App\Console\Commands;

use App\Facades\CotizacionCriptoServiceFacade;
use Illuminate\Console\Command;

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
        return CotizacionCriptoServiceFacade::getCotizacion("Etherum");
    }
}
