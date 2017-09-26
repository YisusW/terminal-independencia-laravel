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

    /**
     * ListineCount belongs to TipoListineJornadaPrice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoListinJornadaPrice()
    {
    	// belongsTo(RelatedModel, foreignKey = tipoListineJornadaPrice_id, keyOnRelatedModel = id)
    	return $this->belongsTo(TipoListinJornadaPrice::class , 'id_tipo_listin_jornada_tipo_listin_price' , 'id');
    }

}
