<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoListinJornada extends Model
{
    //
    protected $table = 'tipo_listin_jornada';
    //
    public function __construct(){

        setlocale(LC_ALL, "es_VE.UTF-8");    	
    }
}
