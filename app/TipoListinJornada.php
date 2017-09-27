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


	/**
	 * TipoListinJornada has many Tipo.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function listines_jornadas()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = tipoListinJornada_id, localKey = id)
		return $this->hasMany(TipoListinJornadaPrice::class , 'id_tipo_listin_jornada' , 'id');
	}

	/**
	 * TipoListinJornada belongs to User.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
		return $this->belongsTo( User::class , 'id_user' , 'id' );
	}


}
