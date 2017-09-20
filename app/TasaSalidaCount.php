<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasaSalidaCount extends Model
{
    //

    public $table = 'tasa_salida_count';

    public function __construct(){

    	setlocale(LC_ALL, "es_VE.utf8");
    }

    /**
     * TasaSalida belongs to TasaSalidaUser.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function TasaSalidaUser()
    {
    	// belongsTo(RelatedModel, foreignKey = tasaSalidaUser_id, keyOnRelatedModel = id)
    	return $this->belongsTo(TasaSalidaUser::class , 'id_tasa_salida_date' , 'id');
    }    
}
