<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoListin extends Model
{
    
    protected $table = 'tipo_listin';
    //
    public function __construct(){

        setlocale(LC_ALL, "es_VE.UTF-8");    	
    }
}
