<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoListinJornadaPrice extends Model
{
    //
    protected $table = 'tipo_listin_jornada_tipo_listin_price';
    //
    public function __construct(){

        setlocale(LC_ALL, "es_VE.UTF-8");    	
    }

    /**
     * TipoListinJornadaPrice belongs to Listine.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function listine()
    {
    	// belongsTo(RelatedModel, foreignKey = listine_id, keyOnRelatedModel = id)
    	return $this->belongsTo(TipoListinPrice::class , 'id_tipo_listin_price' , 'id');
    }

    /**
     * TipoListinJornadaPrice has many ListineCount.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ListineCount()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = tipoListinJornadaPrice_id, localKey = id)
    	return $this->hasMany(ListineCount::class,'id_tipo_listin_jornada_tipo_listin_price','id');
    }
}
