<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasaSalida extends Model
{
    //
    public $table = 'tasa_salida';

    public function __construct(){

    	setlocale(LC_ALL, "es_VE.utf8");
    }



}
