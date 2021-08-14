<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cripto extends Model
{
//    use HasFactory;
    public static $DOLAR = "Dolar";
    public static $PESO = "Peso";
    public static $ETH = "Etherum";

    public static $PESO_ID = 1;
    public static $DOLAR_ID = 2;
    public static $ETH_ID = 3;
}
