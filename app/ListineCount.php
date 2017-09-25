<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListineCount extends Model
{
    protected $table = 'listin_count';
    //
    public function __construct(){

        setlocale(LC_ALL, "es_VE.UTF-8");    	
    }
}
