<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoListinPrice extends Model
{
    //
    protected $table = 'tipo_listin_price';

    public function __construct(){

        setlocale(LC_ALL, "es_VE.UTF-8");    	
    }    

    /**
     * TipoListinPrice belongs to TipoListin.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoListin()
    {
    	// belongsTo(RelatedModel, foreignKey = tipoListin_id, keyOnRelatedModel = id)
    	return $this->belongsTo(TipoListin::class , 'id_tipo_listin' , 'id');
    }
}
