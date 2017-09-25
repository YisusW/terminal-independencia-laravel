<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoListinJornadaPrice extends Model
{
    protected $table = 'tipo_listin_jornada_tipo_listin_price';
    //
    public function __construct(){

        setlocale(LC_ALL, "es_VE.UTF-8");    	
    }
}
