<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasaSalida extends Model
{
    //
    protected $table = 'tasa_salida';

    public function __construct(){

        setlocale(LC_ALL, "es_VE.UTF-8");
    }



}
